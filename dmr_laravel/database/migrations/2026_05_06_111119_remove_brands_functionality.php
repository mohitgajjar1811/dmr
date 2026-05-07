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
        Schema::table('products_product', function (Blueprint $table) {
            // Drop foreign key if it exists. Django usually names them like table_column_id_hash
            // For safety in this case, we just drop the column.
            $table->dropColumn('brand_id');
        });
        
        Schema::dropIfExists('brands_brand');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
