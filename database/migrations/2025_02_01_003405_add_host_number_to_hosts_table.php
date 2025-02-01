<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHostNumberToHostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->string('host_number')->nullable(); // Add Host Number column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->dropColumn('host_number'); // Drop Host Number column
        });
    }
}
