<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cart = new App\Status;
        $cart->name = 'active';
        $cart->description = 'Deze bestelling is nog niet bevestigd.';
        $cart->save();

        $ordered = new App\Status;
        $ordered->name = 'ordered';
        $ordered->description = 'Deze bestelling is besteld en bevestigd door de gebruiker.';
        $ordered->save();

        $ready = new App\Status;
        $ready->name = 'ready';
        $ready->description = 'Deze bestelling is klaargezet en kan worden opgehaald.';
        $ready->save();

        $completed = new App\Status;
        $completed->name = 'completed';
        $completed->description = 'Deze bestelling is betaald en afgehaald.';
        $completed->save();

        $cancelled = new App\Status;
        $cancelled->name = 'cancelled';
        $cancelled->description = 'Deze bestelling is geannuleerd.';
        $cancelled->save();
    }
}
