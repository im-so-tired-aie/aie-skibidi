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
        Schema::create('enrolments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string("name");
            $table->string("nric");
            $table->text("address");
            $table->string("contact_no");
            $table->string("email");
            $table->date("dob");
            $table->enum("gender", ["Male", "Female", "Other"]);
            $table->string("race");
            $table->string("nationality");
            $table->foreignId("programme_id")->constrained("programmes")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolments');
    }
};
