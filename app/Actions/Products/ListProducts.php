<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Fetches products for the collection endpoint in a stable order.
 */
class ListProducts
{
    /**
     * @return Collection<int, Product>
     */
    public function handle() : Collection
    {
        return Product::query()
            ->orderBy('id')
            ->get();
    }
}
