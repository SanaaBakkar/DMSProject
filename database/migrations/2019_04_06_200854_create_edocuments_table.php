<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edocuments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_name');
           // $table->string('doc_keyword')->nullable();
          //  $table->string('doc_owner')->nullable();
            $table->string('doc_prepared_by')->nullable();
            $table->string('doc_reviewed_by')->nullable();
            $table->string('doc_approved_by')->nullable();
            $table->string('doc_description')->nullable();
            //$table->date('doc_sign_date')->nullable();
           // $table->unsignedInteger('doc_nbr_page')->nullable();
            $table->string('doc_status')->nullable();/*contient status */
            $table->unsignedInteger('typdoc_id')->nullable()->index();
            $table->foreign('typdoc_id')->references('id')->on('etypdocs');
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
        Schema::dropIfExists('edocuments');
    }
}
