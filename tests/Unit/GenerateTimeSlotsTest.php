<?php

namespace Tests\Unit;

use App\Services\SlotService;
use PHPUnit\Framework\TestCase;

class GenerateTimeSlotsTest extends TestCase
{
    public function testGeneratesTimeSlotsForAvailableTime()
    {
        $dateRange = [
            'from' => '2024-03-20',
            'to' => '2024-03-20'
        ];

        $availableTime = [
            'from' => '09:00:00',
            'to' => '10:00:00'
        ];

        $excludingDays = [];
        $intervalMinutes = 30;
        $rewritingRules = [];
        $lang = 'en';

        $expectedTimeSlots = [
            [
                'start' => '2024-03-20T09:00:00.000000Z',
                'end' => '2024-03-20T09:30:00.000000Z',
                'timestamp' => strtotime('2024-03-20 09:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-20T09:30:00.000000Z',
                'end' => '2024-03-20T10:00:00.000000Z',
                'timestamp' => strtotime('2024-03-20 09:30:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-20T10:00:00.000000Z',
                'end' => '2024-03-20T10:30:00.000000Z',
                'timestamp' => strtotime('2024-03-20 10:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
        ];

        $slotService = new SlotService();
        $result = $slotService->generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $rewritingRules, $lang);

        $this->assertEquals($expectedTimeSlots, $result);
    }

    public function testExcludeDays()
    {
        $dateRange = [
            'from' => '2024-03-19',
            'to' => '2024-03-22'
        ];

        $availableTime = [
            'from' => '09:00:00',
            'to' => '10:00:00'
        ];

        $excludingDays = ['wednesday', 'thursday'];
        $intervalMinutes = 60;
        $rewritingRules = [];
        $lang = 'en';

        $expectedTimeSlots = [
            [
                'start' => '2024-03-19T09:00:00.000000Z',
                'end' => '2024-03-19T10:00:00.000000Z',
                'timestamp' => strtotime('2024-03-19 09:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-19T10:00:00.000000Z',
                'end' => '2024-03-19T11:00:00.000000Z',
                'timestamp' => strtotime('2024-03-19 10:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-22T09:00:00.000000Z',
                'end' => '2024-03-22T10:00:00.000000Z',
                'timestamp' => strtotime('2024-03-22 09:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-22T10:00:00.000000Z',
                'end' => '2024-03-22T11:00:00.000000Z',
                'timestamp' => strtotime('2024-03-22 10:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
        ];

        $slotService = new SlotService();
        $result = $slotService->generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $rewritingRules, $lang);

        $this->assertEquals($expectedTimeSlots, $result);
    }

    public function testExcludesTimeSlotsBasedOnRules()
    {
        $dateRange = [
            'from' => '2024-03-20',
            'to' => '2024-03-20'
        ];

        $availableTime = [
            'from' => '09:00:00',
            'to' => '11:00:00'
        ];

        $excludingDays = [];
        $intervalMinutes = 30;
        $rewritingRules = [
            [
                'start' => '2024-03-20T09:30:00',
                'end' => '2024-03-20T10:29:00',
                'language' => 'en'
            ]
        ];

        $lang = 'en';

        $expectedTimeSlots = [
            [
                'start' => '2024-03-20T09:00:00.000000Z',
                'end' => '2024-03-20T09:30:00.000000Z',
                'timestamp' => strtotime('2024-03-20 09:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-20T10:30:00.000000Z',
                'end' => '2024-03-20T11:00:00.000000Z',
                'timestamp' => strtotime('2024-03-20 10:30:00'),
                'language' => 'en',
                'is_available' => 1
            ],
            [
                'start' => '2024-03-20T11:00:00.000000Z',
                'end' => '2024-03-20T11:30:00.000000Z',
                'timestamp' => strtotime('2024-03-20 11:00:00'),
                'language' => 'en',
                'is_available' => 1
            ],
        ];

        $slotService = new SlotService();
        $result = $slotService->generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $rewritingRules, $lang);

        $this->assertEquals($expectedTimeSlots, $result);
    }
}
