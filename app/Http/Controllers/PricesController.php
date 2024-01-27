<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PromoCode;
use App\Services\PromocodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricesController extends Controller
{
    public function index()
    {
        $prices = ProductPrice::whereIn('product_id', Product::where('calendar_id', auth()->user()->id)->pluck('id'))->get();

        return view('customer.price.index', compact('prices'));
    }

    public function create()
    {
        $products = Product::where('calendar_id', auth()->user()->id)->get();

        return view('customer.price.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            "price" => ['required', 'numeric'],
            "two-datetime" => ['required', 'string'],
            "product_id" => ['required', 'exists:products,id'],
        ])->validated();

        $date = explode(' - ', $data['two-datetime']);

        unset($data['two-datetime']);

        $data['start_date'] = $date[0];
        $data['end_date'] = $date[1];

        ProductPrice::create($data);

        return redirect()->route('customer.price.index');
    }

    public function edit(int $id)
    {
        $products = Product::where('calendar_id', auth()->user()->id)->get();
        $price = ProductPrice::findOrFail($id);
        $price['datetime'] = implode(' - ',[$price['start_date']->format('m/d/Y H:i:s'), $price['end_date']->format('m/d/Y H:i:s')]);

        return view('customer.price.edit', compact('price', 'products'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(),[
            'id' => ['required'],
            "price" => ['required', 'numeric'],
            "two-datetime" => ['required', 'string'],
            "product_id" => ['required', 'exists:products,id'],
        ])->validated();

        $date = explode(' - ', $data['two-datetime']);

        unset($data['two-datetime']);

        $data['start_date'] = $date[0];
        $data['end_date'] = $date[1];

        $price = ProductPrice::findOrFail($data['id']);
        $price->update($data);

        return redirect()->route('customer.price.index');
    }


    public function delete($id)
    {
        $price = ProductPrice::findOrFail($id);
        $price->delete();

        return redirect()->route('customer.price.index');
    }
}