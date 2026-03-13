<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Actions\Products\ListProducts;
use App\Http\Resources\ProductResource;
use Dedoc\Scramble\Attributes\Endpoint;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Returns the Product collection.
 */
#[Group('Products', 'Manage product records.')]
class IndexProductController extends Controller
{
    #[Endpoint(
        operationId: 'listProducts',
        title: 'List products',
        description: 'Returns the full collection of products.',
    )]
    public function __invoke(ListProducts $listProducts) : AnonymousResourceCollection
    {
        return ProductResource::collection($listProducts->handle());
    }
}
