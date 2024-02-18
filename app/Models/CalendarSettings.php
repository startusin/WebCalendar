<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_id',
        'primary_color',
        'secondary_color',
        'bg_color',
        'logo',
        'default_quantity',
        'banner',
        'excluded_days',
        'working_hr_start',
        'working_hr_end',
        'interval',
        'language',
        'cs_email',
        'purchase_email',
        'item_email',
        'cs_email_title',
        'purchase_email_title',
        'sms_reminder',
        'sms_sender',
        'remind_time',
        'admin_email',
        'admin_email_title'
    ];

    protected $casts = [
        'interval' => 'array',
        'excluded_days' => 'array',
        'default_quantity' => 'array',
        'working_hr_start' => 'array',
        'working_hr_end' => 'array',
        'cs_email' => 'array',
        'purchase_email' => 'array',
        'item_email' => 'array',
        'cs_email_title' => 'array',
        'purchase_email_title' => 'array',
        'sms_reminder' => 'array',
        'sms_sender' => 'array',
        'admin_email' => 'array',
        'admin_email_title' => 'array'
    ];
}
