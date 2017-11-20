<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDepartmentColumnToTrainingSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_seats', function (Blueprint $table) {
            $table->boolean('is_department')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_seats', function (Blueprint $table) {
            $table->dropColumn('is_department');
        });
    }
}
