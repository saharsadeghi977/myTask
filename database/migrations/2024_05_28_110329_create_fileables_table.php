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
        Schema::create('filables', function (Blueprint $table){
            $table->unsignedinteger('file_id');
            $table->unsignedinteger('fileable_id');
            $table->string('fileable_type');
            $table->timestamps();

            $table->unique(['file_id', 'fileable_id', 'fileable_type']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fileables');
    }
};
