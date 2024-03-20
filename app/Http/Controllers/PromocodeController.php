<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PromoCode;
use App\Services\PromocodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromocodeController extends Controller
{
    private $promoService;

    public function __construct(PromocodeService $promoService)
    {
        $this->promoService = $promoService;
    }

    public function checkPromocode(Request $request)
    {
        $promo = $request->input('promo');
        $product = $request->input('product');

        return PromoCode::where('promocode', $promo)
            ->where('product_id', $product)
            ->firstOrFail();
    }

    public function index(Request $request)
    {
        $promocodes = PromoCode::whereIn('product_id', Product::where('calendar_id', $request->calendar_user->id)->pluck('id'))->get();

        return view('customer.promocode.index', compact('promocodes'));
    }

    public function show($id)
    {
        $promocode = PromoCode::findOrFail($id);
        $promocode['product_title'] = Product::select('title')->find($promocode->product_id);

        return $promocode;
    }

    public function create(Request $request)
    {
        $products = Product::where('calendar_id', $request->calendar_user->id)->get();

        return view('customer.promocode.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            "calendar_id" => ['required', 'exists:users,id'],
            "promocode" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "two-datetime" => ['required', 'string'],
            "product_id" => ['required', 'exists:products,id'],
        ])->validated();

        $dataForCreate = $this->promoService->transform($data);
        PromoCode::create($dataForCreate);

        return redirect()->route('customer.promocode.index');
    }


    public function edit(Request $request, int $id)
    {
        $products = Product::where('calendar_id', $request->calendar_user->id)->get();
        $promocode = PromoCode::findOrFail($id);
        $promocode['datetime'] = implode(' - ', [$promocode['start_date']->format('m/d/Y H:i:s'), $promocode['end_date']->format('m/d/Y H:i:s')]);//Треба пофіксити

        return view('customer.promocode.edit', compact('promocode', 'products'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'id' => ['required'],
            "calendar_id" => ['required', 'exists:users,id'],
            "promocode" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "two-datetime" => ['required', 'string'],
            "product_id" => ['required', 'exists:products,id'],
        ])->validated();

        $dataForUpdate = $this->promoService->transform($data);

        $promocode = PromoCode::find($data['id']);

        if (!$promocode) {
            abort(404);
        }

        $promocode->update($dataForUpdate);

        return redirect()->route('customer.promocode.index');
    }


    public function delete($id)
    {
        $promocode = PromoCode::findOrFail($id);
        $promocode->delete();

        return redirect()->route('customer.promocode.index');
    }
}
