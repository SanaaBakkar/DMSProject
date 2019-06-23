<?php
	use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Notifications\InvoicePaid;

use App\EDocument;
use App\Etypdoc;
use App\Workflow;
use App\Wftype;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/*Route::get('/upload','DocumentController@viewaDocuments');
Route::post('/insert','DocumentController@upload');*/

/******************** Document part ********************/

Route::get('/showdocument', 'DocumentController@viewDocument');
Route::get('/document', 'DocumentController@listDocuments');
Route::get('upload','DocumentController@create');
Route::post('upload','DocumentController@store');
Route::get('delete/{id}','DocumentController@deletefile');
Route::get('detail/{id}','DocumentController@detailsfile');
Route::get('update/{id}','DocumentController@update');
Route::post('edit/{id}','DocumentController@edit');

/****************** Workflow part ********************/
Route::get('Typeworkflow/{id}','WorkflowController@TypesWF');
Route::post('typewf','WorkflowController@typeWF');

Route::get('workflow/{id}','WorkflowController@WFSingle');
Route::post('workflowS/{id}','WorkflowController@Add_Single_WF');

Route::get('workflowGroup/{id}','WorkflowController@WFgroup');
Route::post('workflowG/{id}','WorkflowController@Add_Group_WF');

Route::get('workflowParallel/{id}','WorkflowController@WFparallel');
Route::post('workflowParallel/{id}','WorkflowController@Add_users_WF');

Route::get('viewworkflow/{id}','WorkflowController@View_Workflow_detail');






/****************** Task Part ***********************/
Route::get('/task','TaskController@Home');
Route::get('/task/{id}','TaskController@DetailWorkflow');
Route::post('/task/{id}','TaskController@Save');

Route::get('/taskGroup/{id}','TaskController@ShowTaskGroup');
Route::post('/taskGroup/{id}','TaskController@SaveGroup');

Route::get('/taskParallel/{id}','TaskController@ShowTaskParallel');
Route::post('/taskParallel/{id}','TaskController@SaveUsersParallel');

Route::get('/CompletedTask/{id}','TaskController@CompletedTask');
Route::post('/CompletedTask/{id}','TaskController@DisableTask');

 

/*Route::post('/task','TaskController@ActiveTasks');
Route::get('/x',function()
{
			$User = Auth::User()->name;
			echo $User;
	    	$lists = DB::select("select count(*) from workflows where assign_to like '".$User."'");
	    	return $lists;


});*/




Route::get('send', 'HomeController@sendNotification');
 