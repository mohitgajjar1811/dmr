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
        Schema::create('core_aboutpagecontent', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable()->default('Our Story');
            $table->string('title')->nullable()->default('Pioneering Industrial Innovation');
            $table->text('content')->nullable();
            $table->text('quote')->nullable();
            $table->string('cta_title')->nullable()->default('Ready to upgrade your equipment?');
            $table->string('cta_btn_text')->nullable()->default('Explore Our Catalog');
            $table->string('cta_btn_link')->nullable()->default('/products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_aboutpagecontent');
    }
};
