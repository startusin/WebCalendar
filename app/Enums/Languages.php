<?php

namespace App\Enums;

enum Languages: string
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

    public static function getUserLanguages(array $myLang): array
    {
        return array_intersect_key(array_flip(self::getLanguages()), array_flip($myLang));
    }

    public static function getLanguageLabel(string $lang): string
    {
        return array_search($lang, self::getLanguages());
    }

    public static function getTranslateLanguage($key, $lang) {
        $dictionary = [
            'en' => [
                'en' => 'English',
                'fr' => 'Anglais',
            ],
            'fr' => [
                'en' => 'English',
                'fr' => 'Français',
            ]
        ];

        return $dictionary[$key][$lang];
    }
}
