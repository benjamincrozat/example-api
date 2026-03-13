<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;
use App\Data\ProductData;

/**
 * Persists a newly created Product record.
 */
class CreateProduct
{
    public function handle(ProductData $data) : Product
    {
        return Product::query()->create($data->toModelAttributes());
    }
}
