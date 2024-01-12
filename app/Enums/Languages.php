<?php

namespace App\Enums;

enum Languages : string
{
    case English = "en";
    case French = "fr";

    public static function getLanguages(): array
    {
        return [
            self::English->name => self::English->value,
            self::French->name => self::French->value,
        ];
    }

    public static function getMyLanguages(array $myLang): array
    {
        return array_intersect_key(array_flip(self::getLanguages()), array_flip($myLang));
    }

    public static function getStringLanguage(string $lang): string
    {
        return  array_search($lang, self::getLanguages());
    }
}
