<?php

namespace App\Http\Controllers;

use App\Models\Translations;
use App\Services\LangService;
use Illuminate\Http\Request;

class TranslationsController extends Controller
{
    private $langService;

    public function __construct(LangService $langService)
    {
        $this->langService = $langService;
    }

    public function edit()
    {
        $translations = Translations::where('calendar_id', auth()->user()->id)
            ->first();

        if (!$translations) {
            foreach (auth()->user()->languages as $item) {
                switch ($item) {
                    case "en":
                        $this->langService->EnglishWords($translations);
                        break;
                    case "fr":
                        $this->langService->FranceWords($translations);
                        break;
                }
            }
        } else {
            $translations = $translations['translations'];
        }

        return view('customer.translations.edit', compact('translations'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        dd($data);
        unset($data['_token']);
        unset($data['_method']);
        $objToCreateorUpdate['calendar_id'] = $data['calendar_id'];
        unset($data['calendar_id']);
        $Unik = [];
        foreach ($data as $key => $item) {
            $key = explode('_', $key);
            $Unik[$key[1]][$key[0]] = $item;
        }
        $objToCreateorUpdate['translations'] = $Unik;
        Translations::updateOrCreate(['calendar_id' => $objToCreateorUpdate['calendar_id']],
            $objToCreateorUpdate);

        return redirect()->back();
    }
}
