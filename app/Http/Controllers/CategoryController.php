<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::paginate();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json($category, 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $category->update($request->validated());
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
