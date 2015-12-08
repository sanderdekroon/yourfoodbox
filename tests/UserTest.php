<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the user registration.
     * @return void
     */
    public function testNewUserRegistration()
    {
        $this->visit('/register')
            ->type('Naam Test Achternaam', 'name')
            ->type('voorbeeld@example.com', 'email')
            ->type('wachtwoord', 'password')
            ->type('wachtwoord', 'password_confirmation')
            ->press('Registreren')
            ->seePageIs('/')
            ->assertTrue(Auth::check());
    }

    /**
     * Test the login page
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit('/')
         ->click('Inloggen')
         ->seePageIs('/login');
    }

    /**
     * Test the login procedure
     * @return void
     */
    public function testLogin()
    {
        $this->visit('/login')
        ->type('sander@dekroon.xyz', 'email')
        ->type('wachtwoord', 'password')
        ->press('Login')
        ->seePageIs('/')
        ->dontSee('Inloggen')
        ->assertTrue(Auth::check());
    }
}
