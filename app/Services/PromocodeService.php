<?php

namespace App\Services;

class PromocodeService
{
    public function MakePromoForCreateOrUpdate(array $data): array
    {
        $date = explode(' - ',$data['two-datetime']);
        unset($data['two-datetime']);
        $data['start_date'] = $date[0];
        $data['end_date'] = $date[1];
        return $data;
    }
}
