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
        Schema::table('products', function (Blueprint $table) {
            //
                         
            $table->unsignedBigInteger('feature_attribute_id')->nullable()->after('sub_category_id');
            $table->foreign('feature_attribute_id')->references('id')->on('feature_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
                    $table->dropColumn('feature_attribute_id');

        });
    }
};
