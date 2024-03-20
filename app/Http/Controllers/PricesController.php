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
    public function index(Request $request)
    {
        $prices = ProductPrice::whereIn('product_id', Product::where('calendar_id', $request->calendar_user->id)->pluck('id'))->get();

        return view('customer.price.index', compact('prices'));
    }

    public function view()
    {
        return view('customer.price.nprice');
    }

    public function allCustomPrice()
    {
        $id = (request()->input('calendar_id'));
        $prices = ProductPrice::where('calendar_id', $id)->with('product')->get();

        return response()->json($prices);
    }

    public function create(Request $request)
    {
        $products = Product::where('calendar_id', $request->calendar_user->id)->get();

        return view('customer.price.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
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

    public function createOrUpdate(Request $request)
    {
        $data = $request->all();

        if (!isset($data['alldata'])) {
            $data['alldata'] = [];
        }

        ProductPrice::where(['calendar_id' => $data['calendar_id']])->delete();

        foreach ($data['alldata'] as $item) {
            $product_id = $item['product'];
            unset($item['product']);
            $price = $item;
            ProductPrice::create([
                'calendar_id' => $data['calendar_id'],
                'product_id' => $product_id,
                'price' => $price
            ]);
        }

        return response()->noContent();
    }

    public function edit(Request $request, int $id)
    {
        $products = Product::where('calendar_id', $request->calendar_user->id)->get();
        $price = ProductPrice::findOrFail($id);
        $price['datetime'] = implode(' - ', [$price['start_date']->format('m/d/Y H:i:s'), $price['end_date']->format('m/d/Y H:i:s')]);

        return view('customer.price.edit', compact('price', 'products'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
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
