<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create([
            'name' => 'Solicitor Legal Support',
        ]);

        factory(Role::class)->create([
            'name' => 'Paralegal',
        ]);
    }
}
