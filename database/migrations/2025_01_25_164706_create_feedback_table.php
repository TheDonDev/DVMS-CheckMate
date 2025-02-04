<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    public function up()
    {
        if (!Schema::hasTable('feedback')) {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitor_id');
$table->text('feedback')->nullable()->change();
            $table->timestamps();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
        });
    }
    }
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};