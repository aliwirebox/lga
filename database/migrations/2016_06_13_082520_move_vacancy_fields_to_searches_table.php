<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveVacancyFieldsToSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('vacancies');

        Schema::table('searches', function (Blueprint $table) {
            $table->integer('vacancy_salary')->default(0);
            $table->text('vacancy_additional_information');
            $table->integer('vacancy_department_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('salary')->default(0);
            $table->text('additional_information');
            $table->integer('training_seat_id')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('searches', function (Blueprint $table) {
            $table->dropColumn(['vacancy_salary', 'vacancy_additional_information', 'vacancy_department_id']);
        });
    }
}
