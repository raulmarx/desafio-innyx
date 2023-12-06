<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('View');
        $products = Product::paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $this->authorize('Create');
        $data = $request->validated();
        if ($request->image) {
            $data['image'] = $request->image->store('products');
        }
        $product = Product::create($data);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('View');
        $products =Product::findOrFail($id);

        return response()->json(['products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProductRequest $request, string $id)
    {
        $this->authorize('Edit');
        $product = Product::findOrFail($id);
        $data = $request->validated();
        if ($request->image) {
            $data['image'] = $request->image->store('products');
        }
        $product->update($data);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('Delete');
        $product = Product::findOrFail($id);

        $product->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }


    public function getByCategory($id)
    {
        $products = Product::where('category_id', $id)->get();

        return response()->json(['data' => $products]);
    }
}
