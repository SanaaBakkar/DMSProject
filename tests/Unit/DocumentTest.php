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
    /******** To Run Test : vendor/bin/phpunit tests/Unit/DocumentTest.php  **********/
    /** 
     *  test upload file
     **
    public function test_upload_file()
    {
        $this->visit('/login')
             ->type('sanae.bakkar@gmail.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/');

        //create a file from local disk
        $exampleFile = new File('C:\Users\Délégués\Desktop\git-logo.jpg');
        //copy that file to projectroot/storage/app/public/uploads-unittest folder
        Storage::putFileAs('/uploads-unittest', $exampleFile, 'test-picture.jpg');

        //check whether file exists in path
        Storage::assertExists('/uploads-unittest/test-picture.jpg');
       
    }

     /**
     * Test view and update document .
     **
     public function test_update_document()
     {
        $this->visit('/login')
             ->type('sanae.bakkar@gmail.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/')
             ->click('#my_doc')
             ->seePageIs('/document')
             ->click('#edit_doc')
             ->seeStatusCode(200)
             ->type('','description')
             ->type('unit test update','description')
             ->press('update');


     }


    /**
     * Test delete document .
     **/
     public function test_delete_document()
     {
        $this->visit('/login')
             ->type('sanae.bakkar@gmail.com','email')
             ->type('adminadmin','password')
             ->press('Login')
             ->seePageIs('/')
             ->click('#my_doc')
             ->seePageIs('/document')
             ->click('#delete_doc');
        
     }



   
}
