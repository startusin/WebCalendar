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
        $translations = Translations::where('calendar_id', auth()->user()->id)->first();
        $translations = $translations['translations'] ?? $this->langService->getStaticPhrases();

        return view('customer.translations.edit', compact('translations'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['_method']);

        $objData['calendar_id'] = $data['calendar_id'];

        unset($data['calendar_id']);

        $translations = [];

        foreach ($data as $key => $item) {
            $key = explode('_', $key);
            $translations[$key[1]][$key[0]] = $item;
        }

        $objData['translations'] = $translations;

        Translations::updateOrCreate(['calendar_id' => $objData['calendar_id']], $objData);

        return redirect()->back();
    }
}
