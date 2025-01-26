<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('designation');
            $table->string('organization');
            $table->string('email');
            $table->string('phone_number');
            $table->string('id_number');
            $table->enum('visit_type', ['Business', 'Official', 'Educational', 'Social', 'Tour', 'Other']);
            $table->enum('visit_facility', ['Library', 'Administration Block', 'Science Block', 'Auditorium', 'SHS']);
            $table->date('visit_date');
            $table->time('visit_from');
            $table->time('visit_to');
            $table->text('purpose_of_visit');
            $table->string('host_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
}