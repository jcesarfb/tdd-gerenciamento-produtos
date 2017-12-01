<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
   /** @test */
    public function test_usuario_pode_logar()
    {

        $usuario = factory('App\Usuario')->create();
        $this->assertDatabaseHas('usuarios', $usuario->toArray());

        $this->browse(function ($browser) use ($usuario) {
            $browser->visit('/login')
                    ->type('email', $usuario->email)
                    ->type('password', $usuario->senha)
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }
}
