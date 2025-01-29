<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable2025 extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('feedback')) {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->text('feedback');
            $table->timestamps();

            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
        });
    }
    }
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
