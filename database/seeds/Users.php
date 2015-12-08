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
        $admin->name = 'Sander de Kroon';
        $admin->email = 'sander@dekroon.xyz';
        $admin->password = bcrypt('wachtwoord');
        $admin->save();

        $moderator = new User();
        $moderator->name = 'John Doe';
        $moderator->email = 'john@doe.nl';
        $moderator->password = bcrypt('wachtwoord');
        $moderator->save();

        $user = new User();
        $user->name = 'Marie Doe';
        $user->email = 'marie@doe.nl';
        $user->password = bcrypt('wachtwoord');
        $user->save();

        factory(App\User::class, 7)->create();
    }
}
