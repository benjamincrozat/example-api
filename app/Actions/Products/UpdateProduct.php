<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;
use App\Data\ProductData;

/**
 * Applies a full Product update from validated API input.
 */
class UpdateProduct
{
    public function handle(Product $product, ProductData $data) : Product
    {
        $product->fill($data->toModelAttributes());
        $product->save();

        return $product->refresh();
    }
}
