<?php

namespace App\Http\Controllers;

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
        return view('customer.product.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            "calendar_id" => ['required', 'exists:users,id'],
            "title" => ['required', 'string'],
            "short_description" => ['required', 'string'],
            "description" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "max_qty" => ['required', 'numeric'],
        ])->validated();

        Product::create($data);
        return redirect()->route('customer.product.index');
    }

    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        return view('customer.product.edit', compact('product'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(),[
            'id' => ['required'],
            "calendar_id" => ['required', 'exists:users,id'],
            "title" => ['required', 'string'],
            "short_description" => ['required', 'string'],
            "description" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "max_qty" => ['required', 'numeric'],
        ])->validated();

        $product = Product::find($data['id']);

        if (!$product)
        {
            abort(404);
        }
        $product->update($data);
        return redirect()->route('customer.product.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('customer.product.index');
    }
}
