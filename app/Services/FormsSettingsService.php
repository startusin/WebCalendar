<?php

namespace App\Services;

class FormsSettingsService
{
    public function GetAllKeys() {
        $formKeys['First_Name'] = 1;
        $formKeys['Last_Name'] = 1;
        $formKeys['Company'] = 1;
        $formKeys['Street'] = 1;
        $formKeys['Place'] = 1;
        $formKeys['PostalCode'] = 1;
        $formKeys['Ville'] = 1;
        $formKeys['PhoneInput'] = 1;
        $formKeys['EmailInput'] = 1;
        return $formKeys;
    }
}
