<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->increments('id');

            $table->string('NIM');
            $table->decimal('IPK', 5, 2);
            $table->decimal('IPS', 5, 2);
            $table->enum('ganjil_genap', ['GENAP', 'GANJIL']);

            $table->string('tahun_ajaran')->unsigned();

            $table->foreign('NIM')
                ->references('NIM')
                ->on('mahasiswas')
                ->onUpdate('cascade');
            
            $table->foreign('tahun_ajaran')
                ->references('nama')
                ->on('tahun_ajarans')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('nilais');
    }
}
