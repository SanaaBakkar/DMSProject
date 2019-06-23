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

class TaskController extends Controller
{
    public function Home()
    {
  /***send Data to task page when we Assign a new task to a single reviewer ***/
       $workflows_actives = DB::select("select * from workflows where assign_to like '".Auth::User()->name."' and (status like 'In Progress' or status like 'On hold' or status is null)");

      $workflows_completed = DB::select("select * from workflows where created_by like '".Auth::User()->name."' and status like 'Completed' and id_type = 1");
       
  /***send Data to task page when we Assign a new task to a group reviewer ***/
    
  
  

 /*$workflowsGroup_actives= DB::table('workflowgroups')
            ->leftJoin('workflows', 'workflows.id', '=', 'workflowgroups.id_wf')
            ->select('workflowgroups.*','workflows.status')
            ->where('workflowgroups.assign_to','=',Auth::User()->name)
            ->whereNull('workflows.status')
            ->where('workflowgroups.status','In Progress')
            ->orWhere('workflowgroups.status','On hold')
            ->orWhereNull('workflowgroups.status')
            ->get();*/

       $workflowsGroup_actives = DB::select("select wg.*,w.status from workflowgroups wg left join workflows w on wg.id_wf=w.id where wg.assign_to like '".Auth::User()->name."' and (wg.status like 'In Progress' or wg.status like 'On hold' or wg.status is null) and w.status is null");  
           

     $workflowsGroup_completed = DB::select("select * from workflows where created_by like '".Auth::User()->name."' and status like 'Completed' and id_type = 2");

/***send Data to task page when we Assign a new task to a single reviewer ***/


    $workflowsParallel_actives = DB::select("select * from workflowparallels where assign_to like '".Auth::User()->name."' and (status like 'In Progress' or status like 'On hold' or status is null)");

    $workflowsParallel_completed = DB::select("select * from workflows where created_by like '".Auth::User()->name."' and status like 'Completed' and id_type = 3");
     

 return view('/task',compact('workflows_actives','workflows_completed','workflowsGroup_actives','workflowsGroup_completed','workflowsParallel_actives','workflowsParallel_completed'));


}


   public function DetailWorkflow($id)
   {
      $workflow= Workflow::where('id',$id)->where('id_type','=','1')->first();

     return view('/detailworkflow',compact('workflow','workflowParallel'));

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

  public function Save(Request $request,$id)
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

   $users = DB::select("select COUNT(*) as nbr from users where group_id=(select id from groups where name like '".$groupName->assign_to."')" );  
   

   //convert stdclass object to array
    $user = json_decode(json_encode($users),true);
    $NbrUsers="";

        foreach ($user as $us) {
          $NbrUsers=$us['nbr'];
        }
   
    $nbr_users_percentage = round($NbrUsers*($percentage/100),0);

    $nbr_task_completed  =DB::select("select count(*) as nbrcomp FROM workflowgroups WHERE id_doc=".$id_doc." and status like 'Completed'");

    $tasks_comp = json_decode(json_encode($nbr_task_completed),true);

    $NbrTasksCompleted="";

    foreach ($tasks_comp as $nbr) {
      $NbrTasksCompleted=$nbr['nbrcomp'];
    }


/* Record name of all users who have approved in edocuments table at the end */
    $assigns_to = DB::select("select assign_to from workflowgroups where status like 'Completed' and id_doc=".$id_doc);
    $name = "";
    //convert stdclass object to array
    $array = json_decode(json_encode($assigns_to),true);

    foreach ($array as $assign) {
     $name.= $assign['assign_to'].', ';
    }
 

  if ($NbrTasksCompleted==$nbr_users_percentage) {

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

  /* make an interface to show to user detail of it's completed tasks*/
  public function CompletedTask($id)
  {
    $Workflow = Workflow::where('id',$id)->first();
  

    return view('CompletedTask',compact('Workflow'));

}
/* Disable Task when the user make done to it's completed task */
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