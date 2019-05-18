<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHobiSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hobi_siswa', function (Blueprint $table) {
            //$table->bigIncrements('id');

            //Create table hobi_siswa
            $table->bigInteger('id_siswa')->unsigned()->index();
            $table->bigInteger('id_hobi')->unsigned()->index();
            $table->timestamps();

            //Set Primary Key
            $table->primary(['id_siswa', 'id_hobi']);

            //Set Forign Key hobi_siswa --- siswa
            $table->foreign('id_siswa')
                    ->references('id')
                    ->on('siswa')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            //Set Foreign Key hobi_siswa --- hobi
            $table->foreign('id_hobi')
                    ->references('id')
                    ->on('hobi')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hobi_siswa');
    }
}
