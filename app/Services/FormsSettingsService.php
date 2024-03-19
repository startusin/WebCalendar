<?php

namespace App\Services;

class FormsSettingsService
{
    public function getFields()
    {
        return [
            'First_Name' => 1,
            'Last_Name' => 1,
            'Company' => 1,
            'Street' => 1,
            'Place' => 1,
            'PostalCode' => 1,
            'Ville' => 1,
            'PhoneInput' => 1,
            'EmailInput' => 1
        ];
    }
}
