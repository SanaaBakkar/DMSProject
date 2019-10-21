<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Document;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class DocumentTest extends TestCase
{
    
    /**
     *  test upload file
     **
    public function test_upload_file()
    {
        $this->visit('/login')
             ->type('admin@dms.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/home');

        //create a file from local disk
        $exampleFile = new File('C:\Users\PC\Desktop\poster.png');
        //copy that file to projectroot/storage/app/uploads-unittest folder
        Storage::putFileAs('/uploads-unittest', $exampleFile, 'test-pic.png');

        //check whether file exists in path
        Storage::assertExists('/uploads-unittest/test-pic.png');
       
    }

     /**
     * Test view and update document .
     **
     public function test_update_document()
     {
        $this->visit('/login')
             ->type('admin@dms.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/home')
             ->click('#my_doc')
             ->seePageIs('/document')
             ->click('#edit_doc')
             ->seeStatusCode(200)
             ->type('','description')
             ->type('unit test update','description')
             ->press('update');


     }*/


    /**
     * Test delete document .
     **
     public function test_delete_document()
     {
        $this->visit('/login')
             ->type('admin@dms.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/home')
             ->click('#my_doc')
             ->seePageIs('/document')
             ->click('#delete_doc');
        
     }*/



   
}
