<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablasUsersSerialnumberMachines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('serialnumbers', function (Blueprint $table) {
            $table->id();
            $table -> string('serialnumber') -> unique();
            $table -> bigInteger('local_id') -> unique();
        });

        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table -> string('name') -> unique();
            $table -> string('alias') -> unique();
            $table -> bigInteger('local_id');
            $table -> bigInteger('bar_id');
            $table -> bigInteger('delegation_id');
            $table -> string('identificador') -> unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serialnumbers');
        Schema::dropIfExists('machines');
    }
}
