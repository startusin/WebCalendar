<?php

namespace App\Http\Controllers;

use App\Models\CalendarSettings;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
    public function edit()
    {
        return view('customer.emails.edit', [
            'languages' => auth()->user()->languages,
            'settings' => CalendarSettings::where('calendar_id', auth()->user()->id)->first()
        ]);
    }

    public function update(Request $request)
    {
        $csEmail = [];
        $csEmailTitle = [];
        $purchaseEmail = [];
        $adminEmail = [];
        $adminEmailTitle = [];
        $purchaseEmailTitle = [];
        $itemEmail = [];

        foreach ($request->all() as $key => $value) {

            if (str_contains($key, 'cs-email')) {
                $langKey = explode("_", $key);
                $csEmail[$langKey[1]] = $value;
            }

            if (str_contains($key, 'purchase-email')) {
                $langKey = explode("_", $key);
                $purchaseEmail[$langKey[1]] = $value;
            }

            if (str_contains($key, 'admin-email')) {
                $langKey = explode("_", $key);
                $adminEmail[$langKey[1]] = $value;
            }

            if (str_contains($key, 'item-email')) {
                $langKey = explode("_", $key);
                $itemEmail[$langKey[1]] = $value;
            }

            if (str_contains($key, 'title-email-purchase')) {
                $langKey = explode("_", $key);
                $purchaseEmailTitle[$langKey[1]] = $value;
            }

            if (str_contains($key, 'title-admin-purchase')) {
                $langKey = explode("_", $key);
                $adminEmailTitle[$langKey[1]] = $value;
            }

            if (str_contains($key, 'title-email-cs')) {
                $langKey = explode("_", $key);
                $csEmailTitle[$langKey[1]] = $value;
            }
        }

        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
        $settings->main_name = $request->input('main_name');
        $settings->main_email = $request->input('main_email');
        $settings->admin_email = $adminEmail;
        $settings->admin_email_title = $adminEmailTitle;
        $settings->cs_email = $csEmail;
        $settings->cs_email_title = $csEmailTitle;
        $settings->purchase_email = $purchaseEmail;
        $settings->purchase_email_title = $purchaseEmailTitle;
        $settings->item_email = $itemEmail;
        $settings->remind_time = (int)$request->get('remind-time');
        $settings->save();

        return response()->redirectToRoute('emails.edit');
    }

    public function editSms()
    {
        return view('customer.sms.edit', [
            'languages' => auth()->user()->languages,
            'settings' => CalendarSettings::where('calendar_id', auth()->user()->id)->first()
        ]);
    }


    public function updateSms(Request $request)
    {
        $smsReminder = [];
        $smsSender = [];
        $smsRemindTime = $request->input('sms-remind-time') ?? 60;

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'sms-reminder')) {
                $langKey = explode("_", $key);
                $smsReminder[$langKey[1]] = $value;
            }
        }

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'sms-sender')) {
                $langKey = explode("_", $key);
                $smsSender[$langKey[1]] = $value;
            }
        }

        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
        $settings->sms_reminder = $smsReminder;
        $settings->sms_sender = $smsSender;
        $settings->sms_remind_time = $smsRemindTime;
        $settings->save();

        return response()->redirectToRoute('sms.edit');
    }
}
