<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('info_base_id')->index();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->json('info');
        });

        Schema::create('info_bases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('index');
            $table->unsignedBigInteger('info_template_id');
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->index(['model_type','model_id']);
            $table->unique(['index','model_id','model_type']);
            $table->timestamps();
            $table->string('name')->index();
        });

        Schema::create('info_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name')->index();
            $table->timestamps();
            $table->json('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
        Schema::dropIfExists('info_bases');
        Schema::dropIfExists('info_templates');
    }
}
