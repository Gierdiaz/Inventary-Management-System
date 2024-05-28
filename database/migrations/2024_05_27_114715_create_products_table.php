<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->string('name');
            $table->string('description');
            $table->string('barcode');
            $table->decimal('cost_price')->comment('preço de custo');
            $table->decimal('sale_price')->comment('preço de venda');
            $table->integer('stock_quantity');
            $table->string('unit');
            $table->integer('stock_min')->default(0);
            $table->foreignId('profile_id')->nullable()->constrained('profiles');
            $table->timestamps();
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
