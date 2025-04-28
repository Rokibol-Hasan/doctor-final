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
        Schema::create('doctors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();  // Automatically creates an unsignedBigInteger column for 'id'
            
            // Other columns
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete(); // Foreign key to location table
            $table->foreignId('specialization_id')->constrained()->cascadeOnDelete(); // Foreign key to specialization table
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
