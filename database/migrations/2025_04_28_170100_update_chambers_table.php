<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChambersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chambers', function (Blueprint $table) {
            // 1.  No need to rename 'location' to 'address' as it is already 'address'
            // $table->renameColumn('location', 'address');

            // 2. Add the new 'location_id' column
            $table->unsignedBigInteger('location_id')->nullable()->after('hospital_id');

            // 3. Create the foreign key relationship
            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');

             //4. Remove the old location column
             $table->dropColumn('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chambers', function (Blueprint $table) {
            // Reverse the foreign key relationship
            $table->dropForeign(['location_id']);

            // Drop the 'location_id' column
            $table->dropColumn('location_id');

            // Rename 'address' back to 'location'
            $table->renameColumn('address', 'location');  //potential data loss here.
        });
    }
}
