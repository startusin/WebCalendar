<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $titleL = [];
        $shortDL = [];
        $descriptL = [];
        $priceL = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'title') !== false) {
                $langKey = explode("_", $key);
                $titleL[$langKey[0]] = $value;
            }
            if (strpos($key, 'description') !== false) {
                $langKey = explode("_", $key);
                $descriptL[$langKey[0]] = $value;
            }
            if (strpos($key, 'short_description') !== false) {
                $langKey = explode("_", $key);
                $shortDL[$langKey[0]] = $value;
            }
            if (strpos($key, 'price') !== false) {
                $langKey = explode("_", $key);
                $priceL[$langKey[0]] = $value;
            }
        }

        $objToCreate = null;
        $objToCreate['calendar_id'] = $data['calendar_id'];
        $objToCreate['price'] = $priceL;
        $objToCreate['max_qty'] = $data['max_qty'];
        $objToCreate['description'] = $descriptL;
        $objToCreate['short_description'] = $shortDL;
        $objToCreate['title'] = $titleL;

        Product::create($objToCreate);

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

        $titleL = [];
        $shortDL = [];
        $descriptL = [];
        $priceL = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'title') !== false) {
                $langKey = explode("_", $key);
                $titleL[$langKey[0]] = $value;
            }
            if (strpos($key, 'description') !== false) {
                $langKey = explode("_", $key);
                $descriptL[$langKey[0]] = $value;
            }
            if (strpos($key, 'short_description') !== false) {
                $langKey = explode("_", $key);
                $shortDL[$langKey[0]] = $value;
            }
            if (strpos($key, 'price') !== false) {
                $langKey = explode("_", $key);
                $priceL[$langKey[0]] = $value;
            }
        }


        $objToCreate = null;
        $objToCreate['calendar_id'] = $data['calendar_id'];
        $objToCreate['price'] = $priceL;
        $objToCreate['max_qty'] = $data['max_qty'];
        $objToCreate['description'] = $descriptL;
        $objToCreate['short_description'] = $shortDL;
        $objToCreate['title'] = $titleL;

        $product = Product::find($data['id']);

        if (!$product) {
            abort(404);
        }
        $product->update($objToCreate);

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
