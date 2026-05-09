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
        Schema::table('core_aboutpagecontent', function (Blueprint $table) {
            $table->dropColumn(['cta_btn_text', 'cta_btn_link']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('core_aboutpagecontent', function (Blueprint $table) {
            $table->string('cta_btn_text')->nullable()->default('Explore Our Catalog');
            $table->string('cta_btn_link')->nullable()->default('/products');
        });
    }
};
