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

            if (strpos($key, 'cs-email') !== false) {
                $LangKey = explode("_", $key);
                $csEmail[$LangKey[1]] = $value;
            }

            if (strpos($key, 'purchase-email') !== false) {
                $LangKey = explode("_", $key);
                $purchaseEmail[$LangKey[1]] = $value;
            }

            if (strpos($key, 'admin-email') !== false) {
                $LangKey = explode("_", $key);
                $adminEmail[$LangKey[1]] = $value;
            }

            if (strpos($key, 'item-email') !== false) {
                $LangKey = explode("_", $key);
                $itemEmail[$LangKey[1]] = $value;
            }

            if (strpos($key, 'title-email-purchase') !== false) {
                $LangKey = explode("_", $key);
                $purchaseEmailTitle[$LangKey[1]] = $value;
            }

            if (strpos($key, 'title-admin-purchase') !== false) {
                $LangKey = explode("_", $key);
                $adminEmailTitle[$LangKey[1]] = $value;
            }

            if (strpos($key, 'title-email-cs') !== false) {
                $LangKey = explode("_", $key);
                $csEmailTitle[$LangKey[1]] = $value;
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


    public function updateSms(Request $request) {

        $smsReminder = [];
        $smsSender = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'sms-reminder') !== false) {
                $LangKey = explode("_", $key);
                $smsReminder[$LangKey[1]] = $value;
            }
        }

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'sms-sender') !== false) {
                $LangKey = explode("_", $key);
                $smsSender[$LangKey[1]] = $value;
            }
        }

        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
        $settings->sms_reminder = $smsReminder;
        $settings->sms_sender = $smsSender;
        $settings->save();
        return response()->redirectToRoute('sms.edit');
    }
}
