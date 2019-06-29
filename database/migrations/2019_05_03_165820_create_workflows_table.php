<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_doc')->nullable()->index();
            $table->unsignedInteger('id_type')->nullable()->index();
            $table->string('description');
            $table->string('comment')->nullable()->index();
            $table->string('priority'); 
            $table->string('status')->nullable()->index();  
            $table->string('created_by');   
            $table->string('assign_to');  
            $table->integer('percentage')->nullable();              
            $table->date('due_date');               
            $table->boolean('mail')->default(0);             
            $table->foreign('id_doc')->references('id')->on('edocuments');
            $table->foreign('id_type')->references('id')->on('wftypes');
            /*$table->unsignedInteger('id_user')->nullable()->index();
            $table->foreign('id_user')->references('id')->on('users');*/
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
        Schema::dropIfExists('workflows');
    }
}
