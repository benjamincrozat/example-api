<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Transforms Product models into API response payloads.
 *
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    /**
     * @return array{id: int, name: string, description: string|null, created_at: string|null, updated_at: string|null}
     */
    public function toArray(Request $request) : array
    {
        /** @var Product $product */
        $product = $this->resource;

        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'created_at' => $product->created_at?->toJSON(),
            'updated_at' => $product->updated_at?->toJSON(),
        ];
    }
}
