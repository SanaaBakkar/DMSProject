<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Edocument;


class DocumentTest extends DuskTestCase
{
/********** Run :  php artisan dusk tests/Browser/DocumentTest.php  **************/

    /**
     * Test correct data . 
     **/
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
     * Test upload file .
     */
    public function test_upload_document()
    {
        $this->browse(function($browser){
            $browser->visit('/document')
                    ->assertVisible('#add_doc')
                    ->visit(
                    $browser->attribute('#add_doc', 'href')
                           )
                                       
                    ->attach('#fileToUpload','C:\Users\Délégués\Desktop\git-logo.jpg')
                    ->press('Submit') 
                    ->assertSee('Your file has been successfully added')                      
                    ->pause(1000);
        });
    }


    /**
     * Test view and update document .
     **/
     public function test_update_document()
     {
         $this->browse(function($browser){
            $browser->visit('/document')
                    ->click('a[href="detail/5"]')
                    ->assertPathIsNot('/document')
                    ->assertVisible('#edit_doc')
                    ->visit(
                        $browser->attribute('#edit_doc','href')
                            )
                    ->pause(500)
                    ->assertSee('Edit document')
                    ->type('description', '')
                    ->pause(500)
                    ->type('description','Unit test')
                    ->pause(500)
                    ->press('update')  
                    ->assertSee('Document updated successefully !')
                    ->pause(500);

             });
     }

     /**
     * Test delete document .
     **
     */
     public function test_delete_document()
     {
         $this->browse(function($browser){
            $browser->visit('/document')
                    ->click('a[href="/delete/5"]')
                    ->pause(500)
                    ->assertSee('File Deleted successfully');
         });
     }
    
}
