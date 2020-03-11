<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->integer('product_category_id');
            $table->integer('unit_id');
            $table->enum('inventory_val', ['Lifo', 'Fifo']);
            $table->integer('price');
            $table->integer('discount');
            $table->integer('threshold');
            $table->enum('status', ['draft', 'pending', 'completed']);
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->string('created_by');
            $table->string('modified_by')->nullable();            
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_masters');
        
    }
}
