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
            $table->text('permissions')->nullable();
        });

        Schema::create('group_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->unique();
            $table->timestamps();
            $table->string('formatted_name');
            $table->boolean('use_location')->default(0);
            $table->boolean('available_index')->default(0);
            $table->text('required_info');
            $table->text('user_info');
            $table->text('creator_permissions');
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
        Schema::dropIfExists('group_types');
    }
}
