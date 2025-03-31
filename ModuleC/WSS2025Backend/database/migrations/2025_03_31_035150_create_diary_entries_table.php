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
            $table->string('title');
            $table->string('description');
            $table->string('organization');
            $table->string('reflection');
            $table->enum('status', ['Pending','Approved','Rejected']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('hours');
            $table->string("remarks");
            $table->foreignId("category_id")->constrained()->onDelete("cascade");
            $table->foreignId("enrolment_id")->constrained()->onDelete("cascade");
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();        
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
