<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtypdocsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('etypdocs')->insert([
         	['typdoc_title' => 'Microsoft Word Document',
         	 'extension'    =>'DOC',],
            ['typdoc_title' => 'Microsoft Word Open XML Document',
         	 'extension'    =>'DOCX',],
            ['typdoc_title' => 'Plain Text File',
         	 'extension'    =>'TXT',],
         	['typdoc_title' => 'Comma Separated Values File',
         	 'extension'    =>'CSV',],
         	['typdoc_title' => 'PowerPoint Presentation',
         	 'extension'    =>'PPT',], 
         	['typdoc_title' => 'XML File',
         	 'extension'    =>'XML',], 
         	['typdoc_title' => 'JPEG Image',
         	 'extension'    =>'JPG',],
         	['typdoc_title' => 'Portable Network Graphic',
         	 'extension'    =>'PNG',],
         	['typdoc_title' => 'Portable Document Format File',
         	 'extension'    =>'PDF',],
        ]);   
    }
    
}


