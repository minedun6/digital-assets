<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('parent_id')->unsigned()->nullable();
			//$table->integer('original_node_id')->unsigned()->nullable();
			//$table->integer('aws_file_id')->unsigned()->nullable();
			$table->string('text');
			$table->string('url')->nullable();
			$table->integer('level');
			$table->string('icon');
            $table->integer('type_id');
            $table->string('extension')->nullable();
            $table->string('mime_type')->nullable();
			$table->integer('folder_flag')->default(3);
			$table->boolean('is_deletable')->default(1);
			$table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('assets');
    }
}
