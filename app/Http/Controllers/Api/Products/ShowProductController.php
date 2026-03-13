<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Http\Resources\ProductResource;
use Dedoc\Scramble\Attributes\Endpoint;

/**
 * Returns a single Product.
 */
#[Group('Products', 'Manage product records.')]
class ShowProductController extends Controller
{
    #[Endpoint(
        operationId: 'showProduct',
        title: 'Show product',
        description: 'Returns a single product by identifier.',
    )]
    public function __invoke(Product $product) : ProductResource
    {
        return ProductResource::make($product);
    }
}
