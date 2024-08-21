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
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address_one')->nullable(false)->change();
            $table->longText('address_two')->nullable(false)->change();
            $table->unsignedBigInteger('provinces_id')->nullable(false)->change();
            $table->unsignedBigInteger('regencies_id')->nullable(false)->change();
            $table->string('zip_code',10)->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('phone_number',15)->nullable(false)->change();
            $table->string('store_name')->nullable(false)->change();
            $table->unsignedBigInteger('categories_id')->nullable(false)->change();
            $table->integer('store_status')->nullable(false)->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address_one')->nullable(false)->change();
            $table->longText('address_two')->nullable(false)->change();
            $table->unsignedBigInteger('provinces_id')->nullable(false)->change();
            $table->unsignedBigInteger('regencies_id')->nullable(false)->change();
            $table->string('zip_code',10)->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('phone_number',15)->nullable(false)->change();
            $table->string('store_name')->nullable(false)->change();
            $table->unsignedBigInteger('categories_id')->nullable(false)->change();
            $table->integer('store_status')->nullable(false)->change();
        });
    }
};
