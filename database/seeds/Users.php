<?php

use Illuminate\Database\Seeder;
use App\User;

class Users extends Seeder
{
    /**
     * Run the database seeds for users.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->is_guest = false;
        $admin->name = 'Sander de Kroon';
        $admin->phonenumber = '0618448035';
        $admin->email = 'sander@dekroon.xyz';
        $admin->password = bcrypt('wachtwoord');
        $admin->save();

        $moderator = new User();
        $moderator->is_guest = false;
        $moderator->name = 'John Doe';
        $moderator->phonenumber = '0618448035';
        $moderator->email = 'john@doe.nl';
        $moderator->password = bcrypt('wachtwoord');
        $moderator->save();

        $user = new User();
        $user->is_guest = false;
        $user->name = 'Marie Doe';
        $user->phonenumber = '0618448035';
        $user->email = 'marie@doe.nl';
        $user->password = bcrypt('wachtwoord');
        $user->save();

        $guest = new User();
        $guest->is_guest = true;
        $guest->name = 'Gast Gastman';
        $guest->phonenumber = '0612345678';
        $guest->email = 'gast@gastman.com';
        $guest->save();

        factory(App\User::class, 6)->create();
    }
}
