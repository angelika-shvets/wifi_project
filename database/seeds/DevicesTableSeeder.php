<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; 

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 5; $i++) {
            DB::table('devices')->insert([
                'name' => 'device number: '.$i,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
