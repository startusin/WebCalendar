<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\CustomSlot;
use App\Services\SlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SlotController extends Controller
{
    private $slotService;

    public function __construct(SlotService $slotService, Request $request)
    {
        $this->slotService = $slotService;
    }

    public function show($id)
    {
        $slot = CustomSlot::find($id);
        $slot['language'] = Languages::getLanguageLabel($slot['language']);

        return $slot;
    }

    public function view(Request $request)
    {
        $languages = array_flip(Languages::getUserLanguages($request->calendar_user->languages));
        $fullslots = CustomSlot::where('calendar_id', $request->calendar_user->id)->first();
        $slots = !$fullslots ? [] : $fullslots['period_type'];

        return view('customer.slot.index', compact('languages', 'slots'));
    }

    public function allCustomSlots()
    {
        $id = (request()->input('calendar_id'));
        $slots = CustomSlot::where('calendar_id', $id)->get();

        return response()->json($slots);
    }

    public function createOrUpdate(Request $request)
    {
        $data = $request->all();

        if (!isset($data['alldata'])) {
            $data['alldata'] = [];
        }

        Redis::del('slots-' . $data['calendar_id']);

        CustomSlot::where(['calendar_id' => $data['calendar_id']])->delete();

        foreach ($data['alldata'] as $slot) {
            CustomSlot::create([
                'calendar_id' => $data['calendar_id'],
                'period_type' => $slot
            ]);
        }

        return response()->noContent();
    }

    public function create()
    {
        $languages = array_flip(Languages::getUserLanguages(auth()->user()->languages));

        return view('customer.slot.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $userLanguages = array_flip(Languages::getUserLanguages(auth()->user()->languages));
        $data = Validator::make($request->all(), [
            'slot_id' => ['required'],
            'quantity' => ['required'],
            'datetimes' => ['required'],
            'time_hour_start1' => ['required'],
            'time_minute_start1' => ['required'],
            'time_hour_start2' => ['required'],
            'time_minute_start2' => ['required'],
            'is_available' => ['required'],
            'language' => [
                'required',
                Rule::in($userLanguages),
            ]
        ])->validated();

        CustomSlot::create($this->slotService->prepareSlot($data));

        return redirect()->route('customer.slot.index');
    }

    public function edit($id)
    {
        $slot = CustomSlot::find($id);
        $languages = array_flip(Languages::getUserLanguages(auth()->user()->languages));

        return view('customer.slot.edit', compact('slot', 'languages'));
    }

    public function update(Request $request)
    {
        $userLang = array_flip(Languages::getUserLanguages(auth()->user()->languages));
        $data = Validator::make($request->all(), [
            'slot_id' => ['required'],
            'quantity' => ['required'],
            'datetimes' => ['required'],
            'time_hour_start1' => ['required'],
            'time_minute_start1' => ['required'],
            'time_hour_start2' => ['required'],
            'time_minute_start2' => ['required'],
            'is_available' => ['required'],
            'language' => [
                'required',
                Rule::in($userLang),
            ]
        ])->validated();

        $slot = CustomSlot::findOrFail($data['slot_id']);
        $slot->update($this->slotService->prepareSlot($data));

        return redirect()->route('customer.slot.index');
    }

    public function delete($id)
    {
        $slot = CustomSlot::find($id);
        $slot->delete();

        return redirect()->route('customer.slot.index');
    }
}
