<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Notifications\InvoicePaid;

use Mail;
use App\Mail\SendEmail;
use App\EDocument;
use App\Etypdoc;
use App\Workflow;
use App\Wftype;
use App\Models\User;
use App\Group;
use App\Workflowgroup;
use App\Workflowparallel;
use App\Workflowpooled;

class WorkflowController extends Controller
{
   

   /****************** WORKFLOW PART **********************/
public function workflow($id)
{
	$documents=EDocument::find($id);
		
}

public function View_Workflow_detail($id)
{

  /*** Detail about a single review  ***/
   $WorkflowSingle = DB::table('workflows')
            ->leftJoin('edocuments', 'edocuments.id', '=', 'workflows.id_doc')
            ->select('workflows.*','edocuments.*','workflows.created_at as createworkflow')
            ->where('edocuments.id','=',$id)
            ->first();
   $type1 = Wftype::where('id',$WorkflowSingle->id_type)->first();

   /*** Detail about a group review and approve***/
   $WorkflowGroup = Workflowgroup::where('id_doc',$id)->get();

  /*** Detail about a parallel review and approve***/
   $WorkflowParallel = Workflowparallel::where('id_doc',$id)->get();

/*** Detail about a parallel review and approve***/
   $WorkflowPooled = Workflowpooled::where('id_doc',$id)->get();

  return view('ViewWorkflow',compact('documents','WorkflowSingle','type1','WorkflowGroup','WorkflowParallel','WorkflowPooled'));
}


 public function WFSingle($id)
 {   
            $actual_wf = DB::table('wftypes')->where('id','1')->first();
            $wftypes = DB::table('wftypes')->where('id','<>','1')->get();
            $listUsers =DB::table('users')->where('name','not like',Auth::user()->name)->get();
            $documents=EDocument::find($id);


			if ($documents->doc_status=='Not yet started') 
         {

      return view('/SingleWF',compact('documents','listUsers','actual_wf','wftypes'));
       
         }else{
   	  return redirect('/document')->with('WF-info','Already started');
   	          }

 }


public function WFgroup($id)
 {
         $actual_wf = DB::table('wftypes')->where('id','2')->first();
         $wftypes = DB::table('wftypes')->where('id','<>','2')->get();
         $listGroups = DB::table('groups')->get();
         $documents=EDocument::find($id);

     
    return view('/GroupWF',compact('documents','listGroups','actual_wf','wftypes'));
           
}


 public function WFparallel($id)
{
         $actual_wf = DB::table('wftypes')->where('id','3')->first();
         $wftypes = DB::table('wftypes')->where('id','<>','3')->get();
         $listUsers =DB::table('users')->where('name','not like',Auth::user()->name)->get();
         $documents=EDocument::find($id);

    
    return view('/ParallelWF',compact('documents','listUsers','actual_wf','wftypes'));
 }  

public function WFpooled($id)
{
         $actual_wf = DB::table('wftypes')->where('id','4')->first();
         $wftypes = DB::table('wftypes')->where('id','<>','4')->get();
         $listGroups = DB::table('groups')->get();
         $documents=EDocument::find($id);

    
    return view('/PooledWF',compact('documents','listGroups','actual_wf','wftypes'));
}

public function TypesWF(Request $request,$id)
{
     $wftypes = DB::table('wftypes')->get();
     $documents=EDocument::find($id);
     return view('TypesWF',compact('documents','wftypes')); 

}

   public function Add_Single_WF(Request $request,$id)
{
          $documents=EDocument::find($id);
          $data_doc= array('doc_status'=>'On hold');
          EDocument::where('id',$id)->update($data_doc);
           /*echo $documents->doc_status;
            echo "voila ".$request->input('type_Workflow').'<br>'. $request->input('description') .'<br>'.$request->input('Date').'<br>'.$request->input('priority').'<br>'.$request->input('id_user').'<br>';*/

            $path = "/workflow/$id";
            $type_WF = $request->input('typeWF');

  /************ Single Assign *****************/

if(isset($_POST['id_user'])){
        

		         $workflow = new Workflow;
		         $workflow->id_doc = $id;
		         $workflow->id_type = $request->input('type_Workflow');
        		 $workflow->description = $request->input('description');
    			   $workflow->priority = $request->input('priority');
        		 $workflow->created_by = Auth::user()->name;
        		 $id_assign = $request->input('id_user');
             $user =User::find($id_assign);
        		 $workflow->assign_to = $user->name;
        		 $workflow->due_date = $request->input('Date');


     /***********Send mail option **************/
             if(isset($_POST['email'])){

              $subject = "application for approval";
              $message = Auth::user()->name." ask for approbation to it's task' ".$request->input('description')."' ,please connect to DMS application to see more details.";

              $workflow->mail = '1';
              $workflow->save();

                    Mail::to($user->email)->send(new SendEmail($subject,$message) );

             }else{
              $workflow->save();
             }

 
   	return redirect('/document')->with('WF-created','Created');
          
 }else{
      
    return redirect($path)->with('Error-info','Fill all fields');
      }

}
						           

					   

public function Add_Group_WF(Request $request,$id)
{
    $documents=EDocument::find($id);
    $data_doc= array('doc_status'=>'On hold');
    EDocument::where('id',$id)->update($data_doc);

    $path = "/workflowGroup/$id";

/*echo $documents->doc_status;
            echo "voila type ".$request->input('type_Workflow').'<br> descr'. $request->input('description') .'<br> date'.$request->input('Date').'<br> priority'.$request->input('priority').'<br> id_group'.$request->input('id_group').'<br>';*/

  if(isset($_POST['id_group'])){

     /******* Recording data in workflow table-General ********/
                $workflow = new Workflow;
                $workflow->id_doc = $id;
                $workflow->id_type = $request->input('type_Workflow');
                $workflow->description = $request->input('description');
                $workflow->priority = $request->input('priority');
                $workflow->percentage = $request->input('percentage');
                $workflow->created_by = Auth::user()->name;
                $id_assign = $request->input('id_group');
                $group = Group::find($id_assign);
                $workflow->assign_to = $group->name;
                $workflow->due_date = $request->input('Date');

         /**** Search for users of each group ****/
          $users = DB::select("select * from users where group_id=".$id_assign." and name not like '".Auth::user()->name."'");

            if(isset($_POST['email'])){

              $subject = "application for approval";
              $message = Auth::user()->name." ask for approbation to it's task' ".$request->input('description')."' ,please connect to DMS application to see more details.";

              $workflow->mail = '1';
              $workflow->save();
         /***** Send mail to all members of group ****/     
              foreach ($users as $us) {
                    Mail::to($us->email)->send(new SendEmail($subject,$message) );
              }
                    
             }else{
                   $workflow->save();
             }


/*Recording data in workflow group to view detail(each member of group) */
                       
   

        $workflow = Workflow::where('id_doc',$id)->first();
          foreach ($users as $user) {
               $workflowGroup = new Workflowgroup;
               $workflowGroup->id_wf = $workflow->id;              
               $workflowGroup->id_doc = $id;
               $workflowGroup->description = $request->input('description');
               $workflowGroup->priority = $request->input('priority');
               $workflowGroup->created_by = Auth::user()->name;
               $id_assign = $request->input('id_group');
               $group = Group::find($id_assign);
               $workflowGroup->due_date = $request->input('Date');
               $workflowGroup->assign_to =$user->name;
               $workflowGroup->save();

               }
                       
                        
       return redirect('/document')->with('WF-created','Created');
    
 }else{
 
               return redirect($path)->with('Error-info','Fill all fields');
      }

}

public function Add_users_WF($id,Request $request)
{
      $documents=EDocument::find($id);
      $data_doc= array('doc_status'=>'On hold');
      EDocument::where('id',$id)->update($data_doc);

      $path = "/workflowParallel/$id";


  if(isset($_POST['id_user'])){

     /******* Recording data in workflow table-General ********/
             $workflow = new Workflow;
             $workflow->id_doc = $id;
             $workflow->id_type = $request->input('type_Workflow');
             $workflow->description = $request->input('description');
             $workflow->priority = $request->input('priority');
             $workflow->created_by = Auth::user()->name;
             $id_assign = $request->input('id_user');
             $workflow->due_date = $request->input('Date');

             $names ="";
             foreach ($id_assign as $id_user) {
               $user =User::find($id_user);               
               $names .= $user->name.', ';               
             }

             $workflow->assign_to = $names;

          if(isset($_POST['email'])){

              $subject = "application for approval";
              $message = Auth::user()->name." ask for approbation to it's task' ".$request->input('description')."' ,please connect to DMS application to see more details.";

              $workflow->mail = '1';

         /***** Send mail to all users selected ****/  
            foreach ($id_assign as $id_user) {
               $user =User::find($id_user);               
                   $workflow->save();
                    Mail::to($user->email)->send(new SendEmail($subject,$message) );
             }   
                               
             }else{
                   $workflow->save();
             }



/*Recording data in workflowparallel table to view detail of workflow to each user */
                       
       /**** Search for name of  users of each group ****/
      foreach ($id_assign as $id_us) {
               $user =User::find($id_us);               
               $workflowParallel = new Workflowparallel;
               $workflowParallel->id_wf = $workflow->id;              
               $workflowParallel->id_doc = $id;
               $workflowParallel->description = $request->input('description');
               $workflowParallel->priority = $request->input('priority');
               $workflowParallel->created_by = Auth::user()->name;
               $workflowParallel->due_date = $request->input('Date');
               $workflowParallel->assign_to =$user->name;
               $workflowParallel->save();

               }
                      
                       
       return redirect('/document')->with('WF-created','Created');
    
 }else{
 
       return redirect($path)->with('Error-info','Fill all fields');
      }

}

public function Add_user_WF(Request $request,$id)
{
    $documents=EDocument::find($id);
    $data_doc= array('doc_status'=>'On hold');
    EDocument::where('id',$id)->update($data_doc);

    $path = "/workflowPooled/$id";

  if(isset($_POST['id_group'])){

     /******* Recording data in workflow table-General ********/
                $workflow = new Workflow;
                $workflow->id_doc = $id;
                $workflow->id_type = $request->input('type_Workflow'); 
                $workflow->description = $request->input('description');
                $workflow->priority = $request->input('priority');
                $workflow->created_by = Auth::user()->name;
                $id_assign = $request->input('id_group');
                $group = Group::find($id_assign);
                $workflow->assign_to = $group->name;
                $workflow->due_date = $request->input('Date');

         /**** Search for users of each group ****/
          $users = DB::select("select * from users where group_id=".$id_assign." and name not like '".Auth::user()->name."'");

            if(isset($_POST['email'])){

              $subject = "application for approval";
              $message = Auth::user()->name." ask for approbation to it's task' ".$request->input('description')."' ,please connect to DMS application to see more details.";

              $workflow->mail = '1';
              $workflow->save();
         /***** Send mail to all members of group ****/     
              foreach ($users as $us) {
                    Mail::to($us->email)->send(new SendEmail($subject,$message) );
              }
                    
             }else{
                   $workflow->save();
             }


/*Recording data in workflow group to view detail(each member of group) */
                       

        $workflow = Workflow::where('id_doc',$id)->first();
          foreach ($users as $user) {
               $workflowPooled = new Workflowpooled;
               $workflowPooled->id_wf = $workflow->id;              
               $workflowPooled->id_doc = $id;
               $workflowPooled->description = $request->input('description');
               $workflowPooled->priority = $request->input('priority');
               $workflowPooled->created_by = Auth::user()->name;
               $workflowPooled->due_date = $request->input('Date');
               $workflowPooled->assign_to =$user->name;
               $workflowPooled->save();

               }
                       
                        
       return redirect('/document')->with('WF-created','Created');
    
 }else{
 
               return redirect($path)->with('Error-info','Fill all fields');
      }

}



}