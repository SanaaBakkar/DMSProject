<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;


class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testURL()
    {
      $this->browse(function($browser){
        $response = $browser->visit('/login')
                            ->assertPathIs('/login')
                            ->pause(1000);       
      }); 
    }

    /**
     * Submmiting form with empty fields.
     **/
     public function test_Blank_Fields()
    {
        $this->browse(function($browser){

            $browser->visit('/login')
                    ->press('Login')
                    ->assertPathIs('/login')
                    ->pause(1000);
        }); 
    }

    /**
     * Test wrong values(name as an email).
     **/
    public function test_wrong_values()
    {
        $this->browse(function($browser){
            $browser->visit('/login')
                 ->type('email','test')
                 ->type('password','slslsldk')
                 ->press('Login')
                 ->assertPathIs('/login')
                 ->pause(1000);
        }); 
    }

    /**
     * Test mismatch data (wrong password).
     **/
    public function test_mismatch_data()
    {
        $this->browse(function($browser){        
            $browser->visit('/login')
                 ->type('email','admin@dms.com')
                 ->type('password','slslsldk')
                 ->press('Login')
                 ->assertPathIs('/login')
                 ->pause(1000);
        }); 
    }

    /**
     * Test correct data .
     **/
    public function test_correct_data()
    {
        $this->browse(function($browser){        
           $browser->visit('/login')
                 ->type('email','admin@dms.com')
                 ->type('password','adminadmin')
                 ->press('Login')
                 ->assertPathIs('/home')
                 ->pause(1000);
        }); 
    }
}
