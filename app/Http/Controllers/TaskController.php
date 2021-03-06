<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;

use App\Workflow;
use App\Models\User;
use App\Edocument;
use App\Workflowgroup;
use App\Workflowparallel;
use App\Workflowpooled;
 
class TaskController extends Controller
{
    public function Home()
    {
  /***send Data to task page when we Assign a new task to a single reviewer ***/
       $workflows_actives = DB::select("select * from workflows where assign_to like '".Auth::User()->name."' and (status like 'In Progress' or status like 'On hold' or status is null)");

      $workflows_completed = DB::select("select * from workflows where created_by like '".Auth::User()->name."' and status like 'Completed'");
       
  /***send Data to task page when we Assign a new task to a group reviewer ***/
    

       $workflowsGroup_actives = DB::select("select wg.*,w.status as WFstatus from workflowgroups wg left join workflows w on wg.id_wf=w.id where wg.assign_to like '".Auth::User()->name."' and (wg.status like 'In Progress' or wg.status like 'On hold' or wg.status is null) and w.status is null");  
           

 

/***send Data to task page when we Assign a new task to a single reviewer ***/


    $workflowsParallel_actives = DB::select("select * from workflowparallels where assign_to like '".Auth::User()->name."' and (status like 'In Progress' or status like 'On hold' or status is null)");

 
 /***send Data to task page when we Assign a pooled group ***/
    

       $workflowsPooled_actives = DB::select("select wp.*,w.status as WFstatus from workflowpooleds wp left join workflows w on wp.id_wf=w.id where wp.assign_to like '".Auth::User()->name."' and (wp.status like 'In Progress' or wp.status like 'On hold' or wp.status is null) and w.status is null");  
           


    

 return view('/task',compact('workflows_actives','workflows_completed','workflowsGroup_actives','workflowsGroup_completed','workflowsParallel_actives','workflowsParallel_completed','workflowsPooled_actives','workflowsPooled_completed'));


}


   public function ShowTaskSingle($id)
   {
      $workflow= Workflow::where('id',$id)->where('id_type','=','1')->first();

     return view('/TaskSignle',compact('workflow'));

  }

public function ShowTaskGroup($id)
{
      $workflowG = Workflowgroup::where('id',$id)->first();

     return view('/TaskGroup',compact('workflowG'));

}

public function ShowTaskParallel($id)
{
      $workflowParallel = Workflowparallel::where('id',$id)->first();

     return view('/TaskParallel',compact('workflowParallel'));
}

public function ShowTaskPooled($id)
{
     $workflowPooled = Workflowpooled::where('id',$id)->first();

     return view('/TaskPooled',compact('workflowPooled'));
}

  public function SaveSingleAssign(Request $request,$id)
  {
      $status=$request->input('status');
     $this->validate($request,[
                'status'=>'required'
            ]);
            $data1_doc= array(
                'doc_reviewed_by'=>Auth::User()->name,
                'doc_status'=>$status
            );
            $data2_doc= array(
                'doc_reviewed_by'=>Auth::User()->name,
                'doc_approved_by'=>Auth::User()->name,
                'doc_status'=>$status
            );
            $id_doc = $request->input('ID_doc');

 //Save the approved name if the status is completed else save the reviewer name
            if ($status=='Completed') {
                   Edocument::where('id',$id_doc)->update($data2_doc);
            }else{
                   Edocument::where('id',$id_doc)->update($data1_doc);

            }


            $data_WF= array(
                'comment'=>$request->input('comment'),
                 'status'=>$status

            );
            Workflow::where('id',$id)->update($data_WF);

            return redirect('/task')->with('update-wf','msg');
         
  }

  public function SaveGroup(Request $request,$id)
  { 
            $status=$request->input('status');
            $id_doc = $request->input('ID_doc');

            $this->validate($request,[
                'status'=>'required'
            ]);

            $groupName = Workflow::where('id_doc',$id_doc)->first();


            $data_WF= array(
                'comment'=>$request->input('comment'),
                 'status'=>$status
            );
            WorkflowGroup::where('id',$id)->update($data_WF);

/* This part contain Calcul of percentage users who have approved */

   $percentage = $groupName->percentage;
   $group= DB::table('groups')->where('name',$groupName->assign_to)->first();

   
   $NbrUsers  = DB::table('users')->where('group_id',$group->id)->where('name','not like',$groupName->created_by)->count();

   
   
    $nbr_users_percentage = round($NbrUsers*($percentage/100),0);

   
    $nbr_task_completed = DB::table('workflowgroups')->where('id_doc',$id_doc)->where('status','Completed')->count();



/* Record name of all users who have approved in edocuments table at the end */
    $assigns_to = DB::select("select assign_to from workflowgroups where status like 'Completed' and id_doc=".$id_doc);
    $name = "";
    //convert stdclass object to array
    $array = json_decode(json_encode($assigns_to),true);

    foreach ($array as $assign) {
     $name.= $assign['assign_to'].', ';
    }
 

  if ($nbr_task_completed==$nbr_users_percentage) {

              $data_doc = array( 
                'doc_status'=>'Completed',
                'doc_reviewed_by'=>$groupName->assign_to,
                'doc_approved_by'=>$name
                );

              $data_wf = array(
                'status'=>'Completed'
               );

              EDocument::where('id',$id_doc)->update($data_doc);
              Workflow::where('id_doc',$id_doc)->update($data_wf);
            }         

            return redirect('/task')->with('update-wf','msg');

  }

public function SaveUsersParallel($id,Request $request)
{
    $status=$request->input('status');
     $this->validate($request,[
                'status'=>'required'
            ]);

            $data_doc= array(
                'doc_reviewed_by'=>Auth::User()->name,
                'doc_approved_by'=>Auth::User()->name,
                'doc_status'=>$status
            );
            $id_doc = $request->input('ID_doc');

 //Save the approved name if the status is completed else save the reviewer name
        
          $data_WF= array(
                'comment'=>$request->input('comment'),
                 'status'=>$status
            );
           Workflowparallel::where('id',$id)->where('assign_to',Auth::User()->name)                               ->update($data_WF);

       $nbr_users  =DB::table('workflowparallels')->where('id_doc',$id_doc)->count();
       $nbr_tasks_comp  =DB::table('workflowparallels')->where('id_doc',$id_doc)->where('status','Completed')->count();

       $Wfs = DB::table('Workflowparallels')->where('id_doc',$id_doc)->get();

 //convert stdclass object to array
        $WF = json_decode(json_encode($Wfs),true);
        $names="";
            foreach ($WF as $user) {
              $names .= $user['assign_to'].', ';
            }
    if ($nbr_users==$nbr_tasks_comp) {

                  $data_doc = array( 
                    'doc_status'=>'Completed',
                    'doc_reviewed_by'=>$names,
                    'doc_approved_by'=>$names
                    );

                  $data_wf = array(
                    'status'=>'Completed'
                   );

                  EDocument::where('id',$id_doc)->update($data_doc);
                  Workflow::where('id_doc',$id_doc)->update($data_wf);
    }

            return redirect('/task')->with('update-wf','msg');
         
}

public function SaveUserPooled($id,Request $request)
{
            $status=$request->input('status');
            $id_doc = $request->input('ID_doc');

            $this->validate($request,[
                'status'=>'required'
            ]);

            $groupName = Workflow::where('id_doc',$id_doc)->first();


            $data_WF= array(
                'comment'=>$request->input('comment'),
                 'status'=>$status
            );
            Workflowpooled::where('id',$id)->update($data_WF);
    

   //number of user who has approved 
 $nbr_user_approved  = DB::table('workflowpooleds')->where('id_doc',$id_doc)->where('status','Completed')->count();
             if ($nbr_user_approved==1) {
  
  $user_approved  = DB::table('Workflowpooleds')->where('id_doc',$id_doc)->where('status','Completed')->first();
              $data_doc = array( 
                'doc_status'=>'Completed',
                'doc_reviewed_by'=>$groupName->assign_to,
                'doc_approved_by'=>$user_approved->assign_to
                );

              $data_wf = array(
                'status'=>'Completed'
               );

              EDocument::where('id',$id_doc)->update($data_doc);
              Workflow::where('id_doc',$id_doc)->update($data_wf);
             }

       return redirect('/task')->with('update-wf','msg');

}

  /* make an interface to show to user detail of it's completed tasks*/
  public function CompletedTask($id)
  {
    $Workflow = Workflow::where('id',$id)->first();
  

    return view('CompletedTask',compact('Workflow'));

}

/* Disable Task when the user make done to its completed task */
  public function DisableTask($id, Request $request)
  {
    $workflow = Workflow::find($id);
 

    $data_doc= array('doc_status'=>'Done');   
    $data_wf= array('status'=>'Done');   

    Edocument::where('id',$workflow->id_doc)->update($data_doc);
    Workflow::where('id_doc',$workflow->id_doc)->update($data_wf);

return redirect('/task')->with('task-done','msg');

}
}