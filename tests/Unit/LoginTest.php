<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;


class LoginTest extends TestCase
{
     /**
     * Check url response is correct.
     **/
    public function testURL()
    {
         $this->visit('/login')
              ->assertResponseStatus(200);

        
    }

    /**
     * Submmiting form with empty fields.
     **/
     public function test_Blank_Fields()
    {
        $this->visit('/login')
             ->click('Login')
             ->seePageIs('/login');
    }

    /**
     * Test wrong values(name as an email).
     **/
    public function test_wrong_values()
    {

        $this->visit('/login')
             ->type('test','email')
             ->type('slslsldk','password')
             ->press('Login')
             ->seePageIs('/login');
    }

    /**
     * Test mismatch data (wrong password).
     **/
    public function test_mismatch_data()
    {
        $this->visit('/login')
             ->type('admin@dms.com','email')
             ->type('slslsldk','password')
             ->press('Login')
             ->seePageIs('/login');
    }

    /**
     * Test correct data .
     **/
    public function test_correct_data()
    {
    
        $this->visit('/login')
             ->type('admin@dms.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/home');
    }
}
