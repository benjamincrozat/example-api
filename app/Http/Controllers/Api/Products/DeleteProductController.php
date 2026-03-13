<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Actions\Products\DeleteProduct;
use Dedoc\Scramble\Attributes\Endpoint;
use Symfony\Component\HttpFoundation\Response;

/**
 * Deletes a Product.
 */
#[Group('Products', 'Manage product records.')]
class DeleteProductController extends Controller
{
    #[Endpoint(
        operationId: 'deleteProduct',
        title: 'Delete product',
        description: 'Deletes an existing product.',
    )]
    public function __invoke(Product $product, DeleteProduct $deleteProduct) : Response
    {
        $deleteProduct->handle($product);

        return response()->noContent();
    }
}
