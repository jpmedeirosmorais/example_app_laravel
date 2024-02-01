<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('name', 255);
            $table->foreignUuid('category_id')->constrained();
            $table->decimal('price', 8, 2);
            $table->longText('description');
            $table->softDeletes();
            $table->timestamps();
            $table->enum('status', ['active', 'inactive']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
