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
        $langs = Languages::getMyLanguages($request->calendar_user->languages);

        return view('customer.product.create',compact('langs'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $TitleL = [];
        $ShortDL = [];
        $DescriptL = [];
        $PriceL = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'title') !== false) {
                $LangKey = explode("_", $key);
                $TitleL[$LangKey[0]] = $value;
            }
            if (strpos($key, 'description') !== false) {
                $LangKey = explode("_", $key);
                $DescriptL[$LangKey[0]] = $value;
            }
            if (strpos($key, 'short_description') !== false) {
                $LangKey = explode("_", $key);
                $ShortDL[$LangKey[0]] = $value;
            }
            if (strpos($key, 'price') !== false) {
                $LangKey = explode("_", $key);
                $PriceL[$LangKey[0]] = $value;
            }
        }

        $objToCreate = null;
        $objToCreate['calendar_id'] = $data['calendar_id'];
        $objToCreate['price'] = $PriceL;
        $objToCreate['max_qty'] = $data['max_qty'];
        $objToCreate['description'] = $DescriptL;
        $objToCreate['short_description'] = $ShortDL;
        $objToCreate['title'] = $TitleL;

        Product::create($objToCreate);
        return redirect()->route('customer.product.index');
    }

    public function edit(Request $request, int $id)
    {
        $langs = Languages::getMyLanguages($request->calendar_user->languages);

        $product = Product::findOrFail($id);

        return view('customer.product.edit', compact('product', 'langs'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $TitleL = [];
        $ShortDL = [];
        $DescriptL = [];
        $PriceL = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'title') !== false) {
                $LangKey = explode("_", $key);
                $TitleL[$LangKey[0]] = $value;
            }
            if (strpos($key, 'description') !== false) {
                $LangKey = explode("_", $key);
                $DescriptL[$LangKey[0]] = $value;
            }
            if (strpos($key, 'short_description') !== false) {
                $LangKey = explode("_", $key);
                $ShortDL[$LangKey[0]] = $value;
            }
            if (strpos($key, 'price') !== false) {
                $LangKey = explode("_", $key);
                $PriceL[$LangKey[0]] = $value;
            }
        }


        $objToCreate = null;
        $objToCreate['calendar_id'] = $data['calendar_id'];
        $objToCreate['price'] = $PriceL;
        $objToCreate['max_qty'] = $data['max_qty'];
        $objToCreate['description'] = $DescriptL;
        $objToCreate['short_description'] = $ShortDL;
        $objToCreate['title'] = $TitleL;

        $product = Product::find($data['id']);

        if (!$product)
        {
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
