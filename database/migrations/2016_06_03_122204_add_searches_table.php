<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searches', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_qualified_from')->nullable()->default(null);
            $table->date('date_qualified_to')->nullable()->default(null);
            $table->boolean('did_training_firm_offer_position')->nullable()->default(null);
            $table->integer('hirer_id')->nullable()->default(null);
            $table->integer('min_ucas_points')->default(0);
            $table->integer('min_degree_class')->default(0);
            $table->boolean('taken_client_secondment')->nullable()->default(null);
            $table->integer('training_law_firm_id')->nullable()->default(null);
            $table->integer('university_id')->nullable()->default(null);
            $table->integer('vacancy_id')->nullable()->default(null);
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
        Schema::drop('searches');
    }
}
