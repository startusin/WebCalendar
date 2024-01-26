<?php

namespace App\Http\Controllers;

use App\Models\CalendarSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CalendarSettingsController extends Controller
{
    public function edit() {

        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();

        if (!$settings) {
            $settings['primary_color'] = null;
            $settings['secondary_color'] = null;
            $settings['bg_color'] = null;
            $settings['logo'] = null;
            $settings['default_quantity'] = 3;
            $settings['brunch_text'] = '';
        }

        return view('customer.calendarSettings.edit', compact('settings'));
    }

    public function update(Request $request) {

        $data = Validator::make($request->all(), [
            'calendar_id' => ['required', 'numeric'],
            'primary_color' => ['string'],
            'brunch_text' => ['string'],
            'secondary_color' => ['string'],
            'bg_color' => ['string'],
            'logo' => ['file'],
            'default_quantity' => ['numeric'],
            'banner' => ['file']
        ])->validated();

        $oldData = CalendarSettings::where('calendar_id', $data['calendar_id'])->first();

        if (isset($data['logo'])) {
            if ($oldData !=null &&$oldData['logo'] != null) {
                Storage::disk('public')->delete($oldData['logo']);
            }
            $data['logo'] = Storage::disk('public')->put('/images', $data['logo']);
        } elseif ( $oldData!=null &&$oldData['logo'] != null) {
            $data['logo'] = $oldData['logo'];
            var_dump($data['logo']);
        }
        if (isset($data['banner'])) {
            if ($oldData !=null &&$oldData['banner'] != null) {
                Storage::disk('public')->delete($oldData['banner']);
            }
            $data['banner'] = Storage::disk('public')->put('/images', $data['banner']);
        } elseif ( $oldData!=null &&$oldData['banner'] != null) {
            $data['banner'] = $oldData['banner'];
        }

        CalendarSettings::updateOrCreate([
            'calendar_id' => auth()->user()->id
        ],[
            'calendar_id' => $data['calendar_id'],
            'primary_color' =>$data['primary_color'],
            'brunch_text' =>$data['brunch_text'],
            'secondary_color' =>$data['secondary_color'],
            'bg_color' => $data['bg_color'],
            'logo' => $data['logo'] ?? null,
            'default_quantity' => $data['default_quantity'],
            'banner' => $data['banner'] ?? null,
        ]);

        return redirect()->route('calendarSettings.edit');
    }
}
