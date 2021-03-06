<?php

use Illuminate\Database\Seeder;
use App\Models\Information;

class InformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $information = factory(Information::class,50)->create();
        foreach ($information as $info) {
            $residents=factory(\App\Models\Resident::class,4)->create(['information_id'=>$info->id]);
            $register_tables=factory(\App\Models\RegisterTable::class,2)->create(['information_id'=>$info->id]);
            $above_tables=factory(\App\Models\AboveTable::class,2)->create(['information_id'=>$info->id]);
        }

        // \DB::table('information')->insert($information->toArray());
    }
}
