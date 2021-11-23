<?php

namespace Database\Seeders;

use DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->truncateTables([
            'inventories',
            'users',
        ]);


        $this->call([
            UserSeeder::class,
        ]);

        //User::factory(20)->create();
    }

    // Limpia las tablas
    protected function truncateTables(array $tables) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Desactivamos la revisión de claves foráneas
    }

}
