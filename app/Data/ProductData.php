<?php

declare(strict_types=1);

namespace App\Data;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;

/**
 * Value object for validated Product payloads crossing the API boundary.
 */
readonly class ProductData
{
    public function __construct(
        public string $name,
        public ?string $description,
    ) {}

    /**
     * @param  array{name: string, description?: string|null}  $validated
     */
    public static function fromArray(array $validated) : self
    {
        return new self(
            name: $validated['name'],
            description: $validated['description'] ?? null,
        );
    }

    public static function fromRequest(StoreProductRequest|UpdateProductRequest $request) : self
    {
        /** @var array{name: string, description?: string|null} $validated */
        $validated = $request->validated();

        return self::fromArray($validated);
    }

    /**
     * @return array{name: string, description: string|null}
     */
    public function toModelAttributes() : array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
