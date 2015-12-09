<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lwd = new App\City;
        $lwd->name = 'Leeuwarden';
        $lwd->address = 'Wilhelmina Plein, 1234AX';
        $lwd->openingDay = 5;
        $lwd->openingHoursFrom = '07:00:00';
        $lwd->openingHoursTill = '17:00:00';
        $lwd->save();

        $groningen = new App\City;
        $groningen->name = 'Groningen';
        $groningen->address = 'Vismarkt, 9711 JB';
        $groningen->openingDay = 3;
        $groningen->openingHoursFrom = '07:00:00';
        $groningen->openingHoursTill = '17:00:00';
        $groningen->save();
    }
}
