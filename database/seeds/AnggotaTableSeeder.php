<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('anggota')->truncate();
        $members = factory(App\Models\Member::class, 20)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
