<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowpooledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflowpooleds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_wf')->nullable()->index();
            $table->unsignedInteger('id_doc')->nullable()->index();
            $table->string('description');
            $table->string('comment')->nullable()->index();
            $table->string('priority'); 
            $table->string('status')->nullable()->index();  
            $table->string('created_by');   
            $table->string('assign_to');               
            $table->date('due_date');               
            $table->foreign('id_wf')->references('id')->on('workflows');
            $table->foreign('id_doc')->references('id')->on('edocuments');
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
        Schema::dropIfExists('workflowpooleds');
    }
}
