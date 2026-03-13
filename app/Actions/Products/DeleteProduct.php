<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;

/**
 * Removes a Product from persistence.
 */
class DeleteProduct
{
    public function handle(Product $product) : void
    {
        $product->delete();
    }
}
