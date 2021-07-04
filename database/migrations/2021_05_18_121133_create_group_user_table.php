<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('role_id');
            $table->index(['user_id','group_id','role_id']);
            $table->unique(['group_id','user_id']);
            $table->timestamps();
        });

        Schema::create('group_join_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('role_id');
            $table->index(['user_id','group_id','role_id']);
            $table->unique(['group_id','user_id']);
            $table->timestamps();
        });

        Schema::create('extra_group_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->string('name');
            $table->index(['user_id','group_id']);
            $table->unique(['name','group_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_role_user');
        Schema::dropIfExists('group_join_requests');
        Schema::dropIfExists('extra_group_users');
    }
}
