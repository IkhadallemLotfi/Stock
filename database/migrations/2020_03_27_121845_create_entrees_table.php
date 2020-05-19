<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrees', function (Blueprint $table) {
            $table->bigInteger('id_produit');
            $table->date('date_entree');
            $table->integer('quantite');
            $table->string('num_facture');
            $table->primary(['id_produit','date_entree','num_facture']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrees');
    }
}
