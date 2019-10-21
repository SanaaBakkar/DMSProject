<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PooledWorkflowTest extends DuskTestCase
{
  /**
   * Start a Pooled Workflow (IT group)
   */
    public function test_start_group_wf()
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
                    ->select('typeWF','4')
                    ->type('description','test assign a pooled task to a group ')
                    ->press('#start_wf')
                    ->pause(500)
                    ->type('description','test assign a pooled task to a group ')
                    ->type('Date','08-30-2019')
                    ->select('priority','medium')
                    ->pause(500)
                    ->press('#select_group')
                    ->whenAvailable('.modal', function ($modal) 
            {
                    $modal
                    ->assertSee('Groups list')
                    ->radio('id_group','2')
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
     * Approve a Pooled Workflow (One user of group can approve the task )
     */
    public function test_group_approve()
    {
        $this->browse(function($browser){
             $browser->visit('/login')
                    ->type('email','sanae.bakkar@gmail.com')
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
