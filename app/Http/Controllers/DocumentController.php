<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

use App\EDocument;
use App\Etypdoc;
use App\Models\User;



class DocumentController extends Controller
{
 
   public function viewDocument()
    {
        return redirect('/document');
    }


   public function test()
   {
   	    return view('/test');

   }


 public function listDocuments()
   {

	  $documents = Edocument::where('doc_prepared_by',Auth::User()->name)->get();   
	
	  return view('/document',['documents'=>$documents]);
	
   }


 /*public static function viewuploadedDocuments()
   {

	  $documents = DB::table('edocuments')->get();   
	 foreach ($documents as $document):
       $visibility = Storage::getVisibility('public/files/', $document->doc_name);
                              // set visibility to true
       Storage::setVisibility('public/files/', $document->doc_name, 'public');

                              // get the url of the uploaded file
       $url = Storage::url('public/files/', $document->doc_name); 
            // return the url
           // echo $url;
   endforeach;


	  return view('/document',['url'=>$url]);
	
   }

 
    
    /**
    Upload document
     */

    public function create()

    {
        return view('adddocument');
    }


     public function store(Request $request)

    {

        $this->validate($request, [
                'doc_name' => 'required',
                'doc_name.*' => 'mimes:doc,pdf,docx,zip,txt,jpeg,png'
                                                          ]);

        if($request->hasfile('doc_name'))

         { 
           foreach($request->file('doc_name') as $file)

            {
                $name=$file->getClientOriginalName();
                /*$type=$file->getClientMimeType();
                $typedoc= new Etypdoc();
                $typedoc->typdoc_title = $type;
                $typedoc->extension = substr(strrchr($name,'.'),1);
                $typedoc->save();*/
                $extension = $file->getExtension();

                $file->move(public_path().'/files/', $name);  
                $url = Storage::url($name);

            }
         }
               
               
   
               $file= new Edocument();
               $file->doc_name=$name;
               $file->doc_prepared_by = Auth::user()->name;

               if (!empty($_POST['description'])) {
                     $file->doc_description=$_POST['description'];
               }else{
                     $file->doc_description='No description';
               }

               $file->doc_status='Not yet started';

 /*get the id of the type from etypdoc table and store it into document table*/
          $typ = DB::table('etypdocs')->where('extension', substr(strrchr($name,'.'),1))->first();
          $file->typdoc_id = $typ->id;

               $file->save();

     return redirect('/upload')->with('add-success', 'Data Your file has been successfully added');

    }


    public function detailsfile($id)

    {
          $documents=EDocument::find($id);
          return view('detailsfile',['documents'=>$documents]);          
    }

    public function viewdoc($id)
    {       
          $documents = EDocument::find($id);
          $path = public_path().'/files/'.$documents->doc_name;
          $ext =File::extension($path);
              
                if($ext=='pdf'){
                    $content_types='application/pdf';
                   }elseif ($ext=='doc') {
                     $content_types='application/msword';  
                   }elseif ($ext=='docx') {
                     $content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                     }elseif ($ext=='jpeg') {
                     $content_types='image/jpeg';  
                   }
      return response(file_get_contents($path),200)->header('Content-Type',$content_types);
    }

   public function deletefile($id)

    {
          EDocument::where('id',$id)->delete();
          return redirect('/document')->with('delete-file','deleted');
    } 

    /**
      Store documents in database
   */

   
   public function update($id)

    {
          $documents=EDocument::find($id);

            return view('update')->with('documents',$documents); 

    }

   public function edit(Request $request,$id)

    {
          $this->validate($request,[
                'doc_name'=>'required',
                'description'=>'required',
                'status'=>'required'
            ]);
            $data= array(
                'doc_name'=>$request->input('doc_name'),
                'doc_description'=>$request->input('description'),
                'doc_status'=>$request->input('status')

            );
            EDocument::where('id',$id)->update($data);
            return redirect('/document')->with('update-doc','msg');

    }




   public function DocToAdd(Request $request)
    {           

        $this->validate($request,[
    
                '{{$listDoc->id}}'=>'required'
            ]);

       $doc = new Edocument;
            $doc->id= $request->input('{{$listDoc->id}}');
        $verify=Edocument::where('id', $doc->id)->get();

        return view('workflow')->with('verify',$verify);

   }


}
