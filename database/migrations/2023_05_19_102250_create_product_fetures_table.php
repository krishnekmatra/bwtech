<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_fetures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categorys')->onDelete('cascade');

          

             $table->unsignedBigInteger('features_id');
            $table->foreign('features_id')->references('id')->on('features')->onDelete('cascade');
            
            $table->unsignedBigInteger('feature_attribute_id')->nullable();
            $table->foreign('feature_attribute_id')->references('id')->on('feature_attributes')->onDelete('set null');

            $table->string('value')->nullable();

           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_fetures');
    }
};
