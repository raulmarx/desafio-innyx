<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('View');
        $categories = Category::all();
        return CategoryResource::collection($categories);
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $this->authorize('Create');
        $data = $request->validated();
        $category = Category::create($data);

        return new CategoryResource($category);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('View');
        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCategoryRequest $request, string $id)
    {
        $this->authorize('Edit');

        $category = Category::findOrFail($id);

        $data = $request->validated();
        $category->update($data);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('Delete');
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return response()->json(['error' => 'Cannot delete parent row due to foreign key restriction.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
