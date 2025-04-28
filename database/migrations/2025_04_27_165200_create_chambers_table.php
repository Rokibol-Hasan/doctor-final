<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chambers', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();  // Use location_id for relationships
            $table->text('address')->nullable();
            $table->string('visiting_hours')->nullable();
            $table->string('days')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
            
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');  // Foreign key for location_id            
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambers');
    }
};
