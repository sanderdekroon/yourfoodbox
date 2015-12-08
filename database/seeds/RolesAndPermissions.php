<?php

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create three roles: admin, moderator and user.
         */
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Administrator';
        $admin->description = 'Super User Do';
        $admin->save();

        $moderator = new Role();
        $moderator->name = 'moderator';
        $moderator->display_name = 'Moderator';
        $moderator->description = 'Kan alle bestellingen zien en gebruikergegevens opvragen.';
        $moderator->save();

        $user = new Role();
        $user->name = 'user';
        $user->display_name = 'Gebruiker';
        $user->description = 'Standaard gebruiker. Kan bestellingen plaatsen.';
        $user->save();

        /**
         * Attach roles to users.
         */
        $adminUser = User::where('email', '=', 'sander@dekroon.xyz')->first();
        $adminUser->attachRole($admin);

        $moderatorUser = User::where('email', '=', 'john@doe.nl')->first();
        $moderatorUser->attachRole($moderator);

        $normalUser = User::where('email', '=', 'marie@doe.nl')->first();
        $normalUser->attachRole($user);

        /**
         * Create permissions.
         */
        $createPage = new Permission();
        $createPage->name = 'create-page';
        $createPage->display_name = 'Create Pages';
        $createPage->description = 'create new pages';
        $createPage->save();

        $editPage = new Permission();
        $editPage->name = 'edit-page';
        $editPage->display_name = 'Edit Pages';
        $editPage->description = 'edit existing pages';
        $editPage->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users';
        $editUser->description  = 'edit existing users';
        $editUser->save();

        /**
         * Attach permissions to roles.
         */
        $admin->attachPermissions(array($createPage, $editPage, $editUser));
        $moderator->attachPermissions(array($createPage, $editPage));

    }
}
