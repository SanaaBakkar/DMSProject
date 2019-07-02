<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Wftype;
use App\Group;
use App\Workflowparallel;
use App\Workflowgroup;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
    
/********************** Part I: Assign a new task ***************************/

    /*****Display to user all it's tasks(About Single WF)  **********/    
     $workflows_active = DB::select("select * from workflows where assign_to like '".Auth::User()->name."' and (status like 'In Progress' or status like 'On hold' or status is null)");

     $workflows_completed = DB::select("select * from workflows where created_by like '".Auth::User()->name."' and status like 'Completed' ");

    /*******Display to user all it's documents *******/
     $documents = DB::select("select * from edocuments where doc_prepared_by like '".Auth::User()->name."'");

 /******************************* End Part I ********************************/
  

/****************** Part II: Review and approve(Group review) ********************/
    $workflowsGroup_active = DB::select("select wg.*,w.status as WFstatus from workflowgroups wg left join workflows w on wg.id_wf=w.id where wg.assign_to like '".Auth::User()->name."' and (wg.status like 'In Progress' or wg.status like 'On hold' or wg.status is null) and w.status is null");
    
     $workflowsGroup_completed = DB::select("select * from workflowgroups where created_by like '".Auth::User()->name."' and status like 'Completed' ");     

 /******************************* End Part II ***********************************/
 
 /****************** Part III: Parallel Review and approve ********************/
    $workflowsParallel_active = DB::select("select * from workflowparallels where assign_to like '".Auth::User()->name."' and (status like 'In Progress' or status like 'On hold' or status is null)");  

     $workflowsParallel_completed = DB::select("select * from workflowparallels where created_by like '".Auth::User()->name."' and status like 'Completed' ");     

 /******************************* End Part III ***********************************/     

 /****************** Part IV: Pooled Review and approve ********************/
 $workflowsPooled_actives = DB::select("select wp.*,w.status as WFstatus from workflowpooleds wp left join workflows w on wp.id_wf=w.id where wp.assign_to like '".Auth::User()->name."' and (wp.status like 'In Progress' or wp.status like 'On hold' or wp.status is null) and w.status is null");  
           

     $workflowsPooled_completed = DB::select("select * from workflows where created_by like '".Auth::User()->name."' and status like 'Completed' and id_type = 4");
 /******************************* End Part IV ***********************************/     

          return view('home',compact('workflows_active','workflows_completed','documents','workflowsGroup_active','workflowsGroup_completed','workflowsParallel_active','workflowsParallel_completed','workflowsPooled_actives','workflowsPooled_completed'));

      }
    


public function admin()
      {
        return view('admin.home');
      }      
        
    
}
