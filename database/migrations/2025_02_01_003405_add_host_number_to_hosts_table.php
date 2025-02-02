<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHostNumberToHostsTable extends Migration
{
    public function up()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->string('host_number')->unique();
        });
    }

    public function down()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->dropColumn('host_number');
        });
    }
}
