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
        Schema::table('core_homepagecontent', function (Blueprint $table) {
            $table->dropColumn([
                'hero_fallback_title',
                'hero_fallback_text',
                'features_section_enabled',
                'featured_products_title',
                'featured_products_subtitle',
                'cta_title',
                'cta_text',
                'cta_btn_text',
                'cta_btn_link',
                'cta_background_image'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('core_homepagecontent', function (Blueprint $table) {
            $table->string('hero_fallback_title')->nullable();
            $table->text('hero_fallback_text')->nullable();
            $table->boolean('features_section_enabled')->default(true);
            $table->string('featured_products_title')->nullable();
            $table->string('featured_products_subtitle')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_text')->nullable();
            $table->string('cta_btn_text')->nullable();
            $table->string('cta_btn_link')->nullable();
            $table->string('cta_background_image')->nullable();
        });
    }
};
