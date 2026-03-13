<?php

declare(strict_types=1);

use App\Models\Product;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;

it('lists products', function () : void {
    $products = Product::factory()->count(2)->create();

    $response = getJson(route('products.index'));

    $response
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.id', $products[0]->id)
        ->assertJsonPath('data.1.id', $products[1]->id);

    expect($response->headers->get('Content-Type'))->toStartWith('application/json');
});

it('shows a single product', function () : void {
    $product = Product::factory()->create();

    getJson(route('products.show', $product))
        ->assertOk()
        ->assertJsonPath('data.id', $product->id)
        ->assertJsonPath('data.name', $product->name)
        ->assertJsonPath('data.description', $product->description);
});

it('creates a product', function () : void {
    $payload = [
        'name' => 'Standing Desk',
        'description' => 'Electric height-adjustable desk.',
    ];

    postJson(route('products.store'), $payload)
        ->assertCreated()
        ->assertJsonPath('data.name', $payload['name'])
        ->assertJsonPath('data.description', $payload['description']);

    $product = Product::query()->where('name', $payload['name'])->first();

    expect($product)->not()->toBeNull()
        ->and($product?->description)->toBe($payload['description']);
});

it('updates a product', function () : void {
    $product = Product::factory()->create();
    $payload = [
        'name' => 'Updated Product',
        'description' => null,
    ];

    putJson(route('products.update', $product), $payload)
        ->assertOk()
        ->assertJsonPath('data.id', $product->id)
        ->assertJsonPath('data.name', $payload['name'])
        ->assertJsonPath('data.description', $payload['description']);

    $product->refresh();

    expect($product->name)->toBe($payload['name'])
        ->and($product->description)->toBeNull();
});

it('deletes a product', function () : void {
    $product = Product::factory()->create();

    deleteJson(route('products.destroy', $product))
        ->assertNoContent();

    expect(Product::query()->find($product->id))->toBeNull();
});

it('validates product payloads', function () : void {
    postJson(route('products.store'), [
        'name' => '',
        'description' => ['not', 'a', 'string'],
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name', 'description']);
});

it('returns a concise not found payload for missing products', function () : void {
    getJson(route('products.show', ['product' => 999999]))
        ->assertNotFound()
        ->assertExactJson([
            'message' => 'Resource not found.',
        ]);
});
