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
use App\Favorite;


use PhpOffice\PhpWord\Settings;

class DocumentController extends Controller
{
 
   public function viewDocument()
    {
        return redirect('/document');
    }

 
   public function AllDocuments()
   {
      $alldocs = Edocument::where('doc_status','not like','Completed')->where('doc_status','not like','Done')->get(); 
      $role = Role::find(Auth::user()->role_id);

   	  return view('/alldocuments',compact('alldocs','role'));

   }


   public function listDocuments()
   {

	  $documents = Edocument::where('doc_prepared_by',Auth::User()->name)->get();   
	  $role = Role::find(Auth::user()->role_id);

	  return view('/document',['documents'=>$documents],['role'=>$role]);
	
   }

 
   public function create()

    {
        return view('adddocument');
    }

    
    /**
       Upload document
     */

    public function uploadFilePost(Request $request){

        $request->validate([
            'fileToUpload' => 'required|file|max:1024',
        ]);

        $name = $request->file('fileToUpload')->getClientOriginalName();
        $extension = $request->file('fileToUpload')->getClientOriginalExtension();
       

        $request->file('fileToUpload')->storeAs('files',date("dmY").'_'.$name);
   
        $file= new Edocument();
        $file->doc_name=date("dmY").'_'.$name;
        $file->doc_prepared_by = Auth::user()->name;
        $file->doc_status='Not yet started';

        if (!empty($_POST['description'])) 
        {
              $file->doc_description=$_POST['description'];
        }else
        {
              $file->doc_description='No description';
        }

        
  /*get the id of the type from etypdoc table and store it into document table*/
        $type = DB::table('etypdocs')->where('extension', strtoupper($extension))->first();
        $file->typdoc_id = $type->id;
        $file->save();

        return back()->with('success','You have successfully upload file.');

    }


    public function detailsfile($id)

    {
          $documents=EDocument::find($id);
          return view('detailsfile',['documents'=>$documents]);          
    }

  /**
      preview documents
   */  

    public function previewdoc($id)
    {
      $documents = EDocument::find($id);
      $path = Storage::disk('public')->path('public/files/'.$documents->doc_name);
      $type = Etypdoc::find($documents->typdoc_id);
          
     if ($type->extension=='DOCX') {
      // Make sure you have `dompdf/dompdf` in your composer dependencies.
      // Set PDF renderer.
          Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
          Settings::setPdfRendererPath('.');
   
          $path_to = $path.'.pdf';

          $phpWord = \PhpOffice\PhpWord\IOFactory::load($path, 'Word2007');;
          $phpWord->save($path_to,'PDF');

          $content_types='application/pdf'; 

        return response(file_get_contents($path_to),200)->header('Content-Type',$content_types);
     }

      switch ($type->extension) {
          case 'PDF':
            $content_types='application/pdf';
            break;
          case 'JPG':
            $content_types='image/jpg';
            break;
          case 'PNG':
            $content_types='image/jpg';
            break;
          case 'TXT':
            $content_types='text/plain; charset=iso-8859-1';  
            break;
          case 'ZIP':
            $content_types = 'application/zip'; 
            break;
          default:
            # code...
            break;
      }
  
     return response()->file($path, ['Content-Type' => $content_types]);
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
/**
 * Favorite a particular post
 *
 */
    public function FavoriteDoc($id)
    {

        Auth::user()->favorites()->attach($id);

        return back();
    }

/**
 * Unfavorite a particular document
 *
 */
    public function UnFavoriteDoc($id)
    {
        Auth::user()->favorites()->detach($id);

        return back();
    }

 /**
 * Determine whether a document has been marked as favorite by a user.
 *
 */
    public function ListFavorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();

        return view('my_favorites')->with('favorites',$favorites);
    }
}
