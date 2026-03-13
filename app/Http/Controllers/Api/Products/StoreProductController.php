<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Products;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Actions\Products\CreateProduct;
use App\Http\Resources\ProductResource;
use Dedoc\Scramble\Attributes\Endpoint;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Products\StoreProductRequest;
use Dedoc\Scramble\Attributes\Response as ResponseDocument;

/**
 * Creates a new Product.
 */
#[Group('Products', 'Manage product records.')]
class StoreProductController extends Controller
{
    #[Endpoint(
        operationId: 'createProduct',
        title: 'Create product',
        description: 'Creates a new product from a validated JSON payload.',
    )]
    #[ResponseDocument(status: Response::HTTP_CREATED, description: 'Product created.')]
    public function __invoke(StoreProductRequest $request, CreateProduct $createProduct) : JsonResponse
    {
        return ProductResource::make(
            $createProduct->handle($request->productData()),
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
