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
        Schema::table('banners_banner', function (Blueprint $table) {
            $table->string('btn_text')->nullable()->after('subtitle');
            $table->renameColumn('link', 'btn_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners_banner', function (Blueprint $table) {
            $table->renameColumn('btn_link', 'link');
            $table->dropColumn('btn_text');
        });
    }
};
