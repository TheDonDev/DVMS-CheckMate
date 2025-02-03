<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApplyDefaultValuesToTables extends Migration
{
    public function up()
    {
        // Update Hosts table
        Schema::table('hosts', function (Blueprint $table) {
            $table->string('host_name')->default('default_host')->change();
            $table->string('host_email')->default('default@example.com')->change();
            $table->string('host_number')->default('0000000000')->change();
        });

        // Update Visitors table
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('first_name')->default('John')->change();
            $table->string('last_name')->default('Doe')->change();
            $table->string('designation')->default('Visitor')->change();
            $table->string('organization')->default('Default Organization')->change();
            $table->string('email')->default('default@example.com')->change();
            $table->string('phone_number')->default('0000000000')->change();
            $table->string('id_number')->default('00000000')->change();
            $table->text('purpose_of_visit')->default('General Inquiry')->change();
        });

        // Update Feedback table
        Schema::table('feedback', function (Blueprint $table) {
            $table->text('feedback')->default('No feedback provided')->change();
        });
    }

    public function down()
    {
        // Reverse changes if needed
        Schema::table('hosts', function (Blueprint $table) {
            $table->string('host_name')->default(null)->change();
            $table->string('host_email')->default(null)->change();
            $table->string('host_number')->default(null)->change();
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->string('first_name')->default(null)->change();
            $table->string('last_name')->default(null)->change();
            $table->string('designation')->default(null)->change();
            $table->string('organization')->default(null)->change();
            $table->string('email')->default(null)->change();
            $table->string('phone_number')->default(null)->change();
            $table->string('id_number')->default(null)->change();
            $table->text('purpose_of_visit')->default(null)->change();
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->text('feedback')->default(null)->change();
        });
    }
}
