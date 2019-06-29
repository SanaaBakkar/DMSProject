<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Edocument;
use App\Etypdoc;
use App\Workflow;
use App\Group;
use App\Workflowgroup;
use App\Workflowparallel;
use App\Wftype;

class AdminController extends Controller
{

    public function index()
    {
    	return view('admin.home');
    }

    

    public function ShowParallelWF()
    {
    	$workflows  =Workflow::where('id_type','=','3')->get();
    	return view('admin.parallelWF',compact('workflows'));
    }


  /************     Manage Users  ************/  
    public function ShowUsers()
    {
        $users = User::all();
        return view('admin.user.users',compact('users'));
    }

    public function AddUser()
    {
        $listgroups = Group::all();
        return view('admin.user.adduser',compact('listgroups'));
    }

    public function SaveUser(Request $request)
    {
       
            $this->validate($request, [
               'name'=>'required',
                'email'=>'required',
                'group_id'=>'required',
                'admin'=>'required',
                'password'=>'required']);

            $user= new User;
            $user->name= ucfirst($request->input('name'));
            $user->email=  $request->input('email');
            $user->group_id= $request->input('group_id');
            $user->password= bcrypt($request->input('password')) ;
            $user->admin= $request->input('admin');
              
           /******Verify input admin to avoid insering duplicata****/
           
            $verify=User::where('email', $user->email)->get();
            if($verify->count() > 0) {

                return  redirect('/users')->with('error','User already existe!'); 
            }

            else {

                $user->save();
                return redirect('/users')->with('create','created');
           } 
    }

    public function UpdateUser($id)
    {
        $user = User::find($id);
        $groupe_user = Group::find($user->group_id);
        $listgroups = Group::where('id','<>',$user->group_id)->get();

        return view('admin.user.UpdateUser',compact('user','groupe_user','listgroups'));
    }

    public function EditUser(Request $request,$id)
    {
       $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'group_name'=>'required',
                'isadmin'=>'required'
            ]);
            $data= array(
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'group_id'=>$request->input('group_name'),
                'admin'=>$request->input('isadmin')
            );
            User::where('id',$id)->update($data);
            return redirect('/users')->with('update','msg');
    }

    public function DeleteUser($id)
    {
            User::where('id',$id)->delete();
            return redirect('/users')->with('delete','deleted');
    }


    /*******End User part *******/


   /*********   Manage Groups  ********/  
    public function ShowGroups()
    {
        $groups = Group::all();
        return view('admin.group.groups',compact('groups'));
    }


    public function SaveGroup(Request $request)
    {
       
            $this->validate($request, [
               'name'=>'required']);

            $group= new Group;
            $group->name= ucfirst($request->input('name'));

            $group->save();
        return redirect('/groups')->with('create','created');
           
    }

     public function UpdateGroup($id)
    {
        $group = Group::find($id);
        return view('admin.group.UpdateGroup',compact('group'));
    }

    public function EditGroup(Request $request,$id)
    {
        $this->validate($request,[
                'name'=>'required']);

            $data= array(
                'name'=>$request->input('name'));

            Group::where('id',$id)->update($data);
            return redirect('/groups')->with('update','msg');
    }

    public function DeleteGroup($id)
    {
            Group::where('id',$id)->delete();
            return redirect('/groups')->with('delete','deleted');
    }


   /*******End Group part *******/

   /*********   Manage Documents  ********/  
    public function ShowDocuments()
    {
        $documents = Edocument::all();
        return view('admin.document.alldocuments',compact('documents'));
    }

    public function ViewDetail($id)
    {
        $document = Edocument::find($id);
        return view('admin.document.viewdoc',compact('document'));
    }

   /*******End Document part *******/

   /*********   Manage Document types  ********/  
   public function ShowDocType()
    {
        $doc_types= Etypdoc::all();
        return view('admin.doctype.doctypes',compact('doc_types'));
    }

    public function SaveType(Request $request)
    {
        $this->validate($request, [
               'name'=>'required',
                'extension'=>'required']);

            $type= new Etypdoc;
            $type->typdoc_title= $request->input('name');
            $type->extension= strtolower($request->input('extension'));

            $verify=Etypdoc::where(strtolower('extension'), $type->extension)->get();
            if($verify->count() > 0) {

                return  redirect('/doctypes')->with('error','Type already exist!'); 

            }
            else {
                $type->save();
                return redirect('/doctypes')->with('create','created');
           } 
    }

     public function UpdateType($id)
    {
        $type = Etypdoc::find($id);
        return view('admin.doctype.UpdateType',compact('type'));
    }

    public function EditType(Request $request,$id)
    {
        $this->validate($request,[
                'name'=>'required',
                'extension'=>'required']);

            $data= array(
                'typdoc_title'=>$request->input('name'),
                'extension'=>$request->input('extension'));

       
            Etypdoc::where('id',$id)->update($data);
            return redirect('/doctypes')->with('update','msg');
    }

    public function DeleteType($id)
    {
            Etypdoc::where('id',$id)->delete();
            return redirect('/doctypes')->with('delete','deleted');
    }

 /*******End Document types part *******/

/*********   View Workflow  ********/ 

    public function ShowSingleWF()
    {
        $workflows  =Workflow::where('id_type','=','1')->get();
        return view('admin.workflow.singleWF',compact('workflows'));
    }

     public function ShowGroupWF()
    {
        $workflows  =Workflow::where('id_type','=','2')->get();
        return view('admin.workflow.groupWF',compact('workflows'));
    }

    public function View_WF_Detail($id)
    {
         $WorkflowSingle  =Workflow::find($id);
         $WorkflowGroup = Workflowgroup::where('id_wf',$id)->get();
         $WorkflowParallel = Workflowparallel::where('id_wf',$id)->get();

         $type = Wftype::where('id',$WorkflowSingle->id_type)->first();


        return view('admin.workflow.viewWF',compact('type','WorkflowSingle','WorkflowGroup','WorkflowParallel'));
    }

   

  
 /*******End  Workflow part *******/


}
