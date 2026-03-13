<?php

declare(strict_types=1);

namespace App\Http\Requests\Products;

use App\Data\ProductData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Shared validation contract for Product create and update requests.
 */
abstract class UpsertProductRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules() : array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:100'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function productData() : ProductData
    {
        /** @var array{name: string, description?: string|null} $validated */
        $validated = $this->validated();

        return ProductData::fromArray($validated);
    }
}
