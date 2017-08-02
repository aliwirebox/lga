<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreProfileFieldsToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->integer('ucas_points')->nullable()->default(null);
            $table->integer('university_id')->nullable()->default(null);
            $table->string('degree')->default('');
            $table->string('training_law_firm_id')->nullable()->default(null);
            $table->boolean('taken_client_secondment')->default(false);
            $table->date('date_qualified');
            $table->string('current_law_firm_id')->nullable()->default(null);
            $table->boolean('did_training_firm_offer_position')->default(false);
            $table->integer('minimum_salary')->default(0);
            $table->integer('department_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn([             
                'ucas_points',
                'university_id',
                'degree',
                'training_law_firm_id',
                'taken_client_secondment',
                'date_qualified',
                'current_law_firm_id',
                'did_training_firm_offer_position',
                'minimum_salary',
                'department_id',
            ]);
        });
    }
}
