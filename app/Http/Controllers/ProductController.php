<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('calendar_id', auth()->user()->id)->get();

        return view('customer.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function create()
    {
        $langs = Languages::getMyLanguages(auth()->user()->languages);

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

    public function edit(int $id)
    {
        $langs = Languages::getMyLanguages(auth()->user()->languages);

        $product = Product::findOrFail($id);

        return view('customer.product.edit', compact('product', 'langs'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $TitleL = [];
        $ShortDL = [];
        $DescriptL = [];

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
        }


        $objToCreate = null;
        $objToCreate['calendar_id'] = $data['calendar_id'];
        $objToCreate['price'] = $data['price'];
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
}
