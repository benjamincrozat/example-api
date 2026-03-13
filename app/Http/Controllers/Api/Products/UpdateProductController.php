<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Actions\Products\UpdateProduct;
use App\Http\Resources\ProductResource;
use Dedoc\Scramble\Attributes\Endpoint;
use App\Http\Requests\Products\UpdateProductRequest;

/**
 * Replaces a Product with validated API input.
 */
#[Group('Products', 'Manage product records.')]
class UpdateProductController extends Controller
{
    #[Endpoint(
        operationId: 'updateProduct',
        title: 'Update product',
        description: 'Fully replaces an existing product from a validated JSON payload.',
    )]
    public function __invoke(Product $product, UpdateProductRequest $request, UpdateProduct $updateProduct) : ProductResource
    {
        return ProductResource::make(
            $updateProduct->handle($product, $request->productData()),
        );
    }
}
