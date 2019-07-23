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
use App\Role;
use App\Workflow;
use App\Workflowgroup;
use App\Workflowparallel;
use App\Workflowpooled;

use PhpOffice\PhpWord\Settings;

class DocumentController extends Controller
{
 
   public function viewDocument()
    {
        return redirect('/document');
    }


   public function AllDocuments()
   {
      $alldocs = Edocument::all(); 
      $role = Role::find(Auth::user()->role_id);

   	  return view('/alldocuments',compact('alldocs','role'));

   }


 public function listDocuments()
   {

	  $documents = Edocument::where('doc_prepared_by',Auth::User()->name)->get();   
	   $role = Role::find(Auth::user()->role_id);

	  return view('/document',['documents'=>$documents],['role'=>$role]);
	
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
                      // Make sure you have `dompdf/dompdf` in your composer dependencies.
                      Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
                      // Any writable directory here. It will be ignored.
                      Settings::setPdfRendererPath('.');
                      $without_extension = pathinfo($documents->doc_name, PATHINFO_FILENAME);
                      $path_to = public_path().'/files/'.$without_extension.'.pdf';

                      $phpWord = \PhpOffice\PhpWord\IOFactory::load($path, 'Word2007');;
                      $phpWord->save($path_to,'PDF');

                      $content_types='application/pdf';

                return response(file_get_contents($path_to),200)->header('Content-Type',$content_types);
                   }elseif ($ext=='jpeg') {
                     $content_types='image/jpeg';  
                   }elseif ($ext=='jpg') {
                     $content_types='image/jpg';  
                   }elseif ($ext=='png') {
                     $content_types='image/png';  
                   }elseif ($ext=='txt') {
                     $content_types='text/plain charset=utf-8';  
                   }
      return response(file_get_contents($path),200)->header('Content-Type',$content_types);
    }

   public function deletefile($id)

    {
          EDocument::where('id',$id)->delete();
          Workflow::where('id_doc',$id)->delete();
          Workflowgroup::where('id_doc',$id)->delete();
          Workflowparallel::where('id_doc',$id)->delete();
          Workflowpooled::where('id_doc',$id)->delete();


           return redirect()->back()->with('delete-file','deleted');  
 
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
                'description'=>'required',
                'status'=>'required'
            ]);
            $data= array(
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
