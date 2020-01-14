<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SingleWorkflowTest extends DuskTestCase
{
     /**
     * Connect with user account.
     */
    public function test_correct_data()
    {
        $this->browse(function($browser){        
           $browser->visit('/login')
                 ->type('email','sanae.bakkar@gmail.com')
                 ->type('password','adminadmin')
                 ->press('Login')
                 ->assertPathIs('/')
                 ->pause(1000);
        }); 
    }

    /**
    *Test Process of a single workflow
     NOTE: we use check('email') to test email
    */

    public function test_single_wf()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/document')
                    ->assertVisible('#wf')
                    ->visit(
                        $browser->attribute('#wf','href')
                            )
                    ->pause(500)
                    ->select('typeWF','1')
                    ->type('description','test assign a new task to a single assign')
                    ->press('#startwf')
                    ->pause(500)
                    ->type('Date','02-02-2020')
                    ->select('priority','medium')
                    ->press('#select_user')
                    ->whenAvailable('.modal', function ($modal) 
            {
                    $modal
                    ->assertSee('Users list')
                    ->radio('id_user','2')
                    ->press('#save')
                    ->driver->executeScript('window.scrollTo(0, 400);');
            });

         
           $browser ->pause(2000)
                    ->assertSee('Send email')
                    ->pause(2000)
                    ->press('#startwf');
                                                    
        });
    } 
    /**
    *User Logout
    */
    public function test_logout1_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/document')
                    ->assertVisible('#navbarDropdown')
                    ->visit(
                        $browser->attribute('#navbarDropdown','href')
                            )
                    ->press('#navbarDropdown')
                    ->press('#navbarDropdown')
                    ->press('#logout')
                    ->assertPathIs('/login')
                    ->pause(1000);
             }); 
    }

    /**
    * Complete a Task 
    */

    public function test_task_signle_wf()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email','sanae.bakkar95@gmail.com')
                    ->type('password','adminadmin')
                    ->press('Login')
                    ->assertPathIs('/')
                    ->assertVisible('#tasks')
                    ->visit(
                        $browser->attribute('#tasks','href')
                            )
                    ->assertPathIs('/task')
                    ->pause(2000)
                    ->assertSee('My Tasks')
                    ->press('#task_active')
                    ->pause(2000)
                    ->select('status','Completed')
                    ->type('comment',"seen, it's ok ")
                    ->pause(2000)
                    ->press('#Save')
                    ->assertSee('Worfklow Updated successfully')
                    ;
             }); 
    }

     /**
    *User Logout
    */
    public function test_logout2_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/document')
                    ->assertVisible('#navbarDropdown')
                    ->visit(
                        $browser->attribute('#navbarDropdown','href')
                            )
                    ->press('#navbarDropdown')
                    ->press('#navbarDropdown')
                    ->press('#logout')
                    ->assertPathIs('/login')
                    ->pause(1000);
             }); 
    }
    /**
    * Task done
    */

    public function test_task_done()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('email','sanae.bakkar@gmail.com')
                    ->type('password','adminadmin')
                    ->press('Login')
                    ->assertPathIs('/')
                    ->assertVisible('#tasks')
                    ->visit(
                        $browser->attribute('#tasks','href')
                            )
                    ->assertPathIs('/task')
                    ->pause(2000)
                    ->press('#Completed')
                    ->assertSee('Completed Tasks')
                    ->press('#task_completed')
                    ->assertSee('Detail Task')
                    ->press('#Done')
                    ->assertSee('Task Done successfully')
                    ->pause(2000);
        });
    }


}
