<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullCitationCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_citation_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lecturer_id');
            $table->integer('year');
            $table->integer('num_of_citation')->default(0);
            $table->timestamps();

            $table->foreign('lecturer_id')
                ->references('id')
                ->on('lecturers')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('full_citation_counts', function (Blueprint $table) {
            $table->dropForeign('lecturer_id');
            $table->dropForeign('year');
        });
        Schema::dropIfExists('full_citation_counts');
    }
}
