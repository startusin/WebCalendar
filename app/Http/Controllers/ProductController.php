<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('calendar_id', $request->calendar_user->id)
            ->orderBy('priority')
            ->get();

        return view('customer.product.index', compact('products'));
    }

    public function getMyProducts(Request $request)
    {
        $products = Product::where('calendar_id', $request->calendar_user->id)->get();

        return $products;
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return $product;
    }

    public function create(Request $request)
    {
        $langs = Languages::getUserLanguages($request->calendar_user->languages);

        return view('customer.product.create', compact('langs'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $titleLangs = [];
        $shortDescriptionLangs = [];
        $descriptionLangs = [];
        $priceLangs = [];

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'title')) {
                $langKey = explode("_", $key);
                $titleLangs[$langKey[0]] = $value;
            }

            if (str_contains($key, 'description')) {
                $langKey = explode("_", $key);
                $descriptionLangs[$langKey[0]] = $value;
            }

            if (str_contains($key, 'short_description')) {
                $langKey = explode("_", $key);
                $shortDescriptionLangs[$langKey[0]] = $value;
            }
            if (str_contains($key, 'price')) {
                $langKey = explode("_", $key);
                $priceLangs[$langKey[0]] = $value;
            }
        }

        Product::create([
            'calendar_id' => $data['calendar_id'],
            'price' => $priceLangs,
            'max_qty' => $data['max_qty'],
            'description' => $descriptionLangs,
            'short_description' => $shortDescriptionLangs,
            'title' => $titleLangs
        ]);

        return redirect()->route('customer.product.index');
    }

    public function edit(Request $request, int $id)
    {
        $langs = Languages::getUserLanguages($request->calendar_user->languages);

        $product = Product::findOrFail($id);

        return view('customer.product.edit', compact('product', 'langs'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $titleLangs = [];
        $shortDescriptionLangs = [];
        $descriptionLangs = [];
        $priceLangs = [];

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'title')) {
                $langKey = explode("_", $key);
                $titleLangs[$langKey[0]] = $value;
            }
            if (str_contains($key, 'description')) {
                $langKey = explode("_", $key);
                $descriptionLangs[$langKey[0]] = $value;
            }
            if (str_contains($key, 'short_description')) {
                $langKey = explode("_", $key);
                $shortDescriptionLangs[$langKey[0]] = $value;
            }
            if (str_contains($key, 'price')) {
                $langKey = explode("_", $key);
                $priceLangs[$langKey[0]] = $value;
            }
        }

        $product = Product::find($data['id']);

        if (!$product) {
            abort(404);
        }

        $product->update([
            'calendar_id' => $data['calendar_id'],
            'price' => $priceLangs,
            'max_qty' => $data['max_qty'],
            'description' => $descriptionLangs,
            'short_description' => $shortDescriptionLangs,
            'title' => $titleLangs
        ]);

        return redirect()->route('customer.product.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('customer.product.index');
    }

    public function changePriority(Request $request)
    {
        $data = $request->all();

        foreach ($data['idsArray'] as $key => $priority) {
            $product = Product::find($key);

            if ($product) {
                $product['priority'] = $priority;
                $product->save();
            }
        }

        return response()->json('200');
    }
}
