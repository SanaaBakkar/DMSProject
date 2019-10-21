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
use App\Role;
use App\Departement;

class AdminController extends Controller
{

    public function index()
    {
    	return view('admin.home');
    }

    

    public function ShowParallelWF()
    {
    	$workflows  =Workflow::where('id_type','=','3')->get();
    	return view('admin.workflow.parallelWF',compact('workflows'));
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
        $listroles = Role::all();
        $listdepartments = Departement::all();

        return view('admin.user.adduser',compact('listgroups','listroles','listdepartments'));
    }

    public function SaveUser(Request $request)
    {
       
            $this->validate($request, [
               'name'=>'required',
                'email'=>'required',
                'admin'=>'required',
                'password'=>'required',
                'department_id'=>'required',
                'role_id'=>'required']);

            $user= new User;
            $user->name= ucfirst($request->input('name'));
            $user->email=  $request->input('email');
            $user->departement_id = $request->input('department_id');
            $user->role_id= $request->input('role_id');
            $user->group_id = $request->input('group_id');
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
        $group_user = Group::find($user->group_id);
        $listgroups = Group::where('id','<>',$user->group_id)->get();

        $department_user = Departement::find($user->departement_id);
        $listdepartments = Departement::where('id','<>',$user->departement_id)->get();

        $role_user = Role::find($user->role_id);        
        $listroles = Role::where('id','<>',$user->role_id)->get();

        return view('admin.user.UpdateUser',compact('user','group_user','listgroups','department_user','listdepartments','listroles','role_user'));
    }

    public function EditUser(Request $request,$id)
    {
       $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'department_name'=>'required',
                'role_id'=>'required',
                'isadmin'=>'required'
            ]);
            $data= array(
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'departement_id'=>$request->input('department_name'),
                'role_id'=>$request->input('role_id'),
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


/******** Manage departements *********/

    public function ShowDepartments()
    {
        $departments = Departement::all();
        return view('admin.department.departments',compact('departments'));
    }

    public function SaveDepartment(Request $request)
    {
         $this->validate($request, [
               'name'=>'required']);

            $departement= new Departement;
            $departement->name= ucfirst($request->input('name'));
            $verify=Departement::where(ucfirst('name'), $departement->name)->get();

            if ($verify->count() >0) {

                return  redirect('/departments')->with('error','Departement already exist!'); 

            }else{

                $departement->save();
               return redirect('/departments')->with('create','created');                
            }

    }

   public function UpdateDepartment($id)
    {
        $department = Departement::find($id);
        return view('admin.department.UpdateDepartment',compact('department'));
    }

     public function EditDepartment(Request $request,$id)
    {
        $this->validate($request,[
                'name'=>'required']);

            $data= array(
                'name'=>ucfirst($request->input('name')));

            $verify = Departement::where(ucfirst('name'),ucfirst($request->input('name')))->where('id','<>',$id)->get();

            if ($verify->count() >0) {
               
               return redirect('/updatedepartment/'.$id)->with('error','Departement already exist');
            }else{

                Departement::where('id',$id)->update($data);
            return redirect('/departments')->with('update','msg');
            }

            
    }

     public function DeleteDepartment($id)
    {
            Departement::where('id',$id)->delete();
            return redirect('/departments')->with('delete','deleted');
    }

    
    
/******** End departement part *******/

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
            $verify=Group::where(ucfirst('name'), $group->name)->get();

            if ($verify->count() >0) {

                return  redirect('/groups')->with('error','Group already exist!'); 

            }else{

              $group->save();
           return redirect('/groups')->with('create','created');
            }  
           
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
                'name'=>ucfirst($request->input('name')));

    
          $verify = Group::where(ucfirst('name'),ucfirst($request->input('name')))->where('id','<>',$id)->get();

            if ($verify->count() >0) {
               
               return redirect('/updategroup/'.$id)->with('error','Group already exist');
            }else{

                Group::where('id',$id)->update($data);
                return redirect('/groups')->with('update','msg');
            }
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
