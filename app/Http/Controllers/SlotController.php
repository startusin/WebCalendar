<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\BookedSlots;
use App\Models\CustomSlot;
use App\Services\SlotService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SlotController extends Controller
{
    private $slotService;

    public function __construct(SlotService $slotService)
    {
        $this->slotService = $slotService;
    }
    
    public function show($id)
    {
        $slot = CustomSlot::find($id);
        $slot['language'] = Languages::getStringLanguage($slot['language']);
        return $slot;
    }



    public function view()
    {
        $languages = array_flip(Languages::getMyLanguages(auth()->user()->languages));
        $Fullslots = CustomSlot::where('calendar_id', auth()->user()->id)->first();
        $slots = null;
        if (!$Fullslots) {
            $slots = [];
        }
        else {
            $slots = $Fullslots['period_type'];
        }

        return view('customer.slot.index', compact('languages','slots'));
    }

    public function allCustomSlots()
    {
        $id = (request()->input('calendar_id'));
        $slots = CustomSlot::where('calendar_id', $id)->get();

        return response()->json($slots);
    }

    public function  createOrUpdate(Request $request)
    {

        $data = $request->all();

        if (!isset($data['alldata'])){
            $data['alldata'] = [];
        }

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
        $languages = array_flip(Languages::getMyLanguages(auth()->user()->languages));
        return view('customer.slot.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $myLang = array_flip(Languages::getMyLanguages(auth()->user()->languages));
        $data = Validator::make($request->all(), [
            "slot_id" => ['required'],
            "quantity" => ['required'],
            "datetimes" => ['required'],
            "time_hour_start1" => ['required'],
            "time_minute_start1" => ['required'],
            "time_hour_start2" => ['required'],
            "time_minute_start2" => ['required'],
            'is_available' => ['required'],
            "language" => [
                'required',
                Rule::in($myLang),
            ]
        ])->validated();

        $dateForCreate = $this->slotService->MakeSlotForCreate($data);

        CustomSlot::create($dateForCreate);

        return redirect()->route('customer.slot.index');
    }

    public function edit($id)
    {
        $slot = CustomSlot::find($id);
        $languages = array_flip(Languages::getMyLanguages(auth()->user()->languages));

        return view('customer.slot.edit', compact('slot','languages'));
    }
    public function update(Request $request)
    {
        $myLang = array_flip(Languages::getMyLanguages(auth()->user()->languages));
        $data = Validator::make($request->all(), [
            "slot_id" => ['required'],
            "quantity" => ['required'],
            "datetimes" => ['required'],
            "time_hour_start1" => ['required'],
            "time_minute_start1" => ['required'],
            "time_hour_start2" => ['required'],
            "time_minute_start2" => ['required'],
            "is_available" => ['required'],
            "language" => [
                'required',
                Rule::in($myLang),
            ]
        ])->validated();

        $dataForUpdate = $this->slotService->MakeSlotForUpdate($data);
        $slot = CustomSlot::findOrFail($data['slot_id']);
        $slot->update($dataForUpdate);

        return redirect()->route('customer.slot.index');
    }

    public function delete($id)
    {
        $slot = CustomSlot::find($id);
        $slot->delete();
        return redirect()->route('customer.slot.index');
    }
}
