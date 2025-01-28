<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Host's name
            $table->string('email')->unique(); // Host's email
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}
