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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('position', 50);
            $table->string('nationality', 100);
            $table->date('birth_date');
            $table->string('birth_place', 100);
            $table->string('passport_number', 50);
            $table->decimal('salary', 15, 2);
            $table->date('contract_start');
            $table->date('contract_end');
            $table->text('medical_record')->nullable();
            $table->string('agent_name', 100);
            $table->string('contact_email', 100)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->unsignedBigInteger('club_id');
            $table->string('api_token');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
