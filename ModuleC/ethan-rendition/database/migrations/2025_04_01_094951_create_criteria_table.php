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
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")->constrained("categories")->cascadeOnDelete();
            $table->foreignId("programme_id")->constrained("programmes")->cascadeOnDelete();
            $table->integer("required_hours");
            $table->integer("required_duration");
            $table->integer("required_project");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria');
    }
};
