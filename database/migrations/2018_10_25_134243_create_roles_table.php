<?php

use App\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('candidates', function ($table) {
            $table->integer('role_id')->unsigned()->index();
        });

        Schema::table('searches', function ($table) {
            $table->integer('role_id')->unsigned()->nullable()->index();
        });

        Role::create([
            'name' => 'Solicitor Legal Support',
        ]);

        Role::create([
            'name' => 'Paralegal',
        ]);

        DB::table('candidates')->update(['role_id' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');

        Schema::table('candidates', function ($table) {
            $table->dropColumn(['role_id']);
        });

        Schema::table('searches', function ($table) {
            $table->dropColumn(['role_id']);
        });
    }
}
