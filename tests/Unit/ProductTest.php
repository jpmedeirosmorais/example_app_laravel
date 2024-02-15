<?php

use \App\Models\Product;
use \App\Models\Category;
use \App\Models\User;

describe('should create, update, read, list and delete with success', function() {
    beforeEach(function() {
        $user = User::first() ?? User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
        $this->withToken($token);
    });


    it('should create product with success', function() {
        $category = Category::first() ?? Category::factory()->create();
        $product = Product::create([
            'name' => 'Product Test',
            'category_id' => $category->id,
            'price' => 101.99,
            'description' => 'Product Test Description'
        ]);

        expect($product->name)->toBe('Product Test');
        expect($product->category_id)->toBe($category->id);
        expect($product->price)->toBe(101.99);
        expect($product->description)->toBe('Product Test Description');
    });

    it('should list products with success', function() {
        Product::factory(10)->create();
        $response = $this->getJson(route('products.index'));

        expect($response)->assertStatus(200)->assertJsonCount(10, 'data');
    });

    it('should show product with success', function() {
        $category = Category::first() ?? Category::factory()->create();
        $product = Product::create([
            'name' => 'Product Test',
            'category_id' => $category->id,
            'price' => 101.99,
            'description' => 'Product Test Description'
        ]);

        $response = $this->getJson(route('products.show', $product->id))->getContent();

        expect($response)->toContain('Product Test');
        expect($response)->toContain('Product Test Description');
        expect($response)->toContain('101.99');
        expect($response)->toContain($category->id);

    });

    it('should update product with success', function() {
        $category = Category::first() ?? Category::factory()->create();
        $product = Product::create([
            'name' => 'Product Test',
            'category_id' => $category->id,
            'price' => 101.99,
            'description' => 'Product Test Description'
        ]);

        $product->update([
            'name' => 'Product Test Updated',
            'category_id' => $category->id,
            'price' => 10.5,
        ]);

        expect($product->name)->toBe('Product Test Updated');
        expect($product->price)->toBe(10.5);
    });

    it('should delete product with success', function() {
        $category = Category::first() ?? Category::factory()->create();

        $product = Product::create([
            'name' => 'Product Test',
            'category_id' => $category->id,
            'price' => 101.99,
            'description' => 'Product Test Description'
        ]);

        $product->delete();

        expect(Product::find($product->id))->toBeNull();
    });
});
