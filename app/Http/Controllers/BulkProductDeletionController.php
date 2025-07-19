<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BulkProductDeletionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $ids): \Illuminate\Http\RedirectResponse
    {
        $ids = explode(',', $ids);
        Product::destroy($ids);

        return redirect()
            ->route('products.index')
            ->with('message', 'Selected Products deleted successfully.');
    }
}
