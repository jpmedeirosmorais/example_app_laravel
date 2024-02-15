<?php

use \App\Models\User;
use \App\Models\Product;
use \App\Models\Category;

describe('Authenticated', function () {
    beforeEach(function () {
        $user = User::first() ?? User::factory()->create();

        $token = $user->createToken('TestToken')->plainTextToken;

        $this->withToken($token);
    });

    it('should require parameters', function () {
        $response = $this->postJson(route('products.store'));

        expect($response)->assertStatus(422)->assertJsonValidationErrors(['name', 'category_id', 'price']);
    });

    it('should create product with success', function () {
        $category = Category::first() ?? Category::factory()->create();

        $response = $this->postJson(route('products.store'), [
            'name' => 'Product Test',
            'category_id' => $category->id,
            'price' => 101.99,
            'description' => 'Product Test Description'
        ]);

        expect($response)->assertStatus(201)->assertJsonStructure(['data' => ['id', 'name', 'description', 'price', 'category_id', 'status']]);
    });

    it('should list products with success', function () {
        $response = $this->getJson(route('products.index'));
        expect($response)->assertStatus(200)->assertJsonStructure(['data' => [['id', 'name', 'description', 'price', 'category_id', 'status']]]);
    });

    it('should show product with success', function () {
        $product = Product::first() ?? Product::factory()->create();

        $response = $this->getJson(route('products.show', $product->id));

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => ['id', 'name', 'description', 'price', 'category_id', 'status']]);
    });

    it('should update product with success', function () {
        $category = Category::first() ?? Category::factory()->create();
        $product = Product::first() ?? Product::factory()->create();
        $response = $this->putJson(route('products.update', $product->id), [
            'name' => 'Product Test Updated',
            'category_id' => $category->id,
            'price' => 10.5,
        ]);

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => ['id', 'name', 'description', 'price', 'category_id', 'status']]);
    });

    it('should delete product with success', function () {
        $product = Product::first() ?? Product::factory()->create();

        $response = $this->deleteJson(route('products.destroy', $product->id));

        expect($response)->assertStatus(204)->assertNoContent();
    });
});

describe('Unauthenticated', function () {
    it('should require authentication in index', function () {
        $response = $this->getJson(route('products.index'));

        expect($response)->assertStatus(401);
    });

    it('should require authentication in store', function () {
        $response = $this->postJson(route('products.store'));

        expect($response)->assertStatus(401);
    });

    it('should require authentication in show', function () {
        $response = $this->getJson(route('products.show', '1'));

        expect($response)->assertStatus(401);
    });

    it('should require authentication in update', function () {
        $response = $this->putJson(route('products.update', '1'));

        expect($response)->assertStatus(401);
    });

    it('should require authentication in destroy', function () {
        $response = $this->deleteJson(route('products.destroy', '1'));

        expect($response)->assertStatus(401);
    });

});



