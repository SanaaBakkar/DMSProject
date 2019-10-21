<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParallelWorkflowTest extends DuskTestCase
{
   /**
     * Start parallel Workflow (Assign a task to multiple users in parallel: 2users)
     */
    public function test_start_parallel_wf()
    {
        $this->browse(function($browser){        
           $browser->visit('/login')
                 ->type('email','admin@dms.com')
                 ->type('password','adminadmin')
                 ->press('Login')
                 ->assertPathIs('/home')
                 ->pause(1000)
                 ->press('#my_doc')
                 ->assertVisible('#wf')
                 ->visit(
                        $browser->attribute('#wf','href')
                            )
                    ->pause(500)
                    ->select('typeWF','3')
                    ->type('description','test assign a new task to a parallel users ')
                    ->press('#start_wf')
                    ->pause(500)
                    ->type('description','test assign a new task to a parallel users  ')
                    ->type('Date','08-30-2019')
                    ->select('priority','medium')
                    ->pause(500)
                    ->press('#select_users')
                    ->whenAvailable('.modal', function ($modal) 
            {
                    $modal
                    ->assertSee('Users list')
                    ->check('id_user[]','3')
                    ->check('id_user[]','4')
                    ->press('#Save')
                    ->driver->executeScript('window.scrollTo(0, 400);');
            });   

            $browser->pause(500)
                    ->press('#start_wf')
                    ->assertSee('Workflow Started')
                    ->pause(2000);
        });        

    }

     /**
    * Test Logout Feature
    **/
    public function test_logout_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/document')
                    ->assertVisible('#navbarDropdown')
                    ->visit(
                        $browser->attribute('#navbarDropdown','href')
                            )
                    ->press('#navbarDropdown')
                    ->press('#logout')
                    ->assertPathIs('/login')
                    ->pause(1000);
             }); 
    }

    /**
     * Approve a Group Workflow (50% of IT group == 2 users should complete the task )
     */
    public function test_parallel_approve()
    {
        $this->browse(function($browser){
             $browser->visit('/login')
                    ->type('email','sanae.bakkar95@gmail.com')   //User 1
                    ->type('password','adminadmin')
                    ->press('Login')
                    ->assertPathIs('/home')
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
                    ->pause(500)
                    ->assertVisible('#navbarDropdown')
                    ->visit(
                        $browser->attribute('#navbarDropdown','href')
                            )
                    ->press('#navbarDropdown')
                    ->press('#logout')
                    ->assertPathIs('/login')
                    ->pause(1000)
                    ->type('email','ga.analytics.wordpress@gmail.com')   //User 2
                    ->type('password','adminadmin')
                    ->press('Login')
                    ->assertPathIs('/home')
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
                    ->type('comment',"seems to be good ")
                    ->press('#Save')
                    ->pause(2000)
                    ->assertSee('Worfklow Updated successfully')
                    ->pause(500);
        });
    }

     /**
    * Task done
    */
     public function test_task_done()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('email','admin@dms.com')
                    ->type('password','adminadmin')
                    ->press('Login')
                    ->assertPathIs('/home')
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