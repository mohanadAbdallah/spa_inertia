<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $products = request()->user()
            ->products()
            ->with('category')
            ->where(function ($query) {
                if ($search = request()->search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                }
            })
            ->when(!request()->query('sort_by'), function ($query) {
                $query->latest();
            })
            ->when(in_array(request()->query('sort_by'), ['name', 'price', 'brand', 'weight']), function ($query) {
                $sortBy = request()->query('sort_by');

                $field = ltrim($sortBy, '-');
                $direction = str_starts_with($sortBy, '-') ? 'desc' : 'asc';

                $query->OrderBy($field, $direction);
            })
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('Product/Index', [
            'products' => $products->toResourceCollection(),
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
            'query' => (object)request()->query
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Product/Create', [
            'categories' => CategoryResource::collection(Category::orderBy('name')->get())
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->products()->create($request->validated());

        return redirect()->route('products.index')
            ->with('message', 'Product has been stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): \Inertia\Response
    {
        return Inertia::render('Product/Show', ['product' => ProductResource::make($product)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): \Inertia\Response
    {
        return Inertia::render('Product/Edit', [
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
            'product' => ProductResource::make($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->update($request->validated());
        return redirect()->route('products.index')
            ->with('message', 'Product has been updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('message', 'Product has been deleted successfully.');
    }
}
