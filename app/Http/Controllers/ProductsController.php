<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $builder = Products::query();

        if ($request->get('search_string')) {
            $builder->where('title', 'like', '%' . $request->get('search_string') . '%');
        }

        return $builder->get();
    }

    public function show(int $id)
    {
        return Products::find($id);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:100',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $product = Products::create($request->all());

        return response()->json($product, 201);
    }

    public function update(Request $request, int $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:100',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $product = Products::findOrFail($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function delete(Request $request, int $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return 204;
    }
}
