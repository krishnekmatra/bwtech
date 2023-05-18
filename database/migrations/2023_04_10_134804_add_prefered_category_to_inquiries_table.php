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
        Schema::table('inquiries', function (Blueprint $table) {
            //
             $table->string('prefered_category')->null()->after('enquiry');
             $table->string('prefered_brand')->null();
             $table->string('delivery_date')->null();
             $table->float('min')->null();
             $table->float('max')->null();
             $table->string('type')->null();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquiries', function (Blueprint $table) {
            //
        });
    }
};
