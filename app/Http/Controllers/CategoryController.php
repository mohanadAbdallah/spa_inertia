<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $categories = Category::latest()->paginate(5);

        return Inertia::render('Category/Index', ['categories' => $categories->toResourceCollection()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->with('message', 'New Category Created Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): \Inertia\Response
    {
        return Inertia::render('Category/Edit', ['category' => CategoryResource::make($category)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')
            ->with('message', 'Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('message', 'Category Deleted Successfully.');
    }
}
