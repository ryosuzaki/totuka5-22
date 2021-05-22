<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->timestamps();
            $table->float('longitude',10,7)->nullable();
            $table->float('latitude',10,7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_locations');
    }
}
