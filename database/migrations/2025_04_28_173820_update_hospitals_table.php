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
        Schema::table('hospitals', function (Blueprint $table) {
            // 1. Remove the existing foreign key constraint
            $table->dropForeign(['location_id']);
    
            // 2.  Make location_id nullable *before* dropping the column
            $table->dropColumn('location_id');
    
             // 3. Add location_id
            $table->unsignedBigInteger('location_id')->nullable()->after('name');
            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            // Reverse the foreign key.  This assumes 'location_id' existed *before* this migration
           $table->dropForeign(['location_id']);
           $table->dropColumn('location_id');
   
           $table->unsignedBigInteger('location_id')->nullable(); // Add back the location_id
           $table->foreign('location_id')
               ->references('id')
               ->on('locations')
               ->onDelete('cascade');
       });
    }
};
