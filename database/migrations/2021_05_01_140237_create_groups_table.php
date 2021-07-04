<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_type_id')->index();
            $table->timestamps();
            $table->string('name')->index();
            $table->string('unique_name')->default('');
            $table->json('permissions')->nullable();
        });

        Schema::create('group_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->index()->unique();
            $table->timestamps();
            $table->float('longitude',10,7)->nullable();
            $table->float('latitude',10,7)->nullable();
        });

        Schema::create('group_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->unique();
            $table->timestamps();
            $table->string('formatted_name');
            $table->boolean('need_location');
            $table->json('required_info');
            $table->json('user_info');
            $table->json('creator_permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_roles');
        Schema::dropIfExists('group_locations');
        Schema::dropIfExists('group_types');
    }
}
