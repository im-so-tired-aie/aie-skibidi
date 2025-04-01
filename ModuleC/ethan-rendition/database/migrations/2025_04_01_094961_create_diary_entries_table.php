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
        Schema::create('diary_entries', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->string("organization");
            $table->text("reflection");
            $table->enum("status", ['Pending', 'Approved', 'Rejected']);
            $table->date("start_date");
            $table->date("end_date");
            $table->integer("hours");
            $table->text("remarks");
            $table->foreignId("enrolment_id")->constrained("enrolments")->cascadeOnDelete();
            $table->foreignId("category_id")->constrained("categories")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_entries');
    }
};
