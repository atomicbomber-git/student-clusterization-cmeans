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

            $table->integer('mahasiswa_id')->unsigned();
            $table->enum('ganjil_genap', ['GENAP', 'GANJIL']);
            $table->integer('tahun_ajaran_id')->unsigned();

            $table->decimal('IPK', 5, 2);
            $table->decimal('IPS', 5, 2);

            $table->foreign('mahasiswa_id')
                ->references('id')
                ->on('mahasiswas');

            $table->foreign('tahun_ajaran_id')
                ->references('id')
                ->on('tahun_ajarans');

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
