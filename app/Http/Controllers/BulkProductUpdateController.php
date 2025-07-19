<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class BulkProductUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(BulkProductUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        Product::whereIn('id', $request->product_ids)->update([
            'category_id' => $request->category_id
        ]);
        return redirect()
            ->route('products.index')
            ->with('message', 'Selected products updated successfully.');
    }
}
