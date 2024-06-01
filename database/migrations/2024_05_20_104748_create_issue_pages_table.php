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
        Schema::create('issue_pages', function (Blueprint $table) {
            $table->id('IssueId');
            $table->string('username');
            $table->string('rig');
            $table->string('title');
            $table->string('description');
            $table->string('date');
            $table->string('images')->nullable();
            $table->string('status')->default('Pending');
            $table->string('closed_by')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_pages');
    }
};
