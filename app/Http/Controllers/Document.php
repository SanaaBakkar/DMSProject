<?php

namespace App\controllers;

use App\models\Document_model;
use App\models\Folder_model;
use App\models\User;
use Sys\Carbon;
use Sys\Sippy_model;
use Sys\support\checkPermissions;
use Sys\Basecontroller;
use Sys\Pagination;

use App\helpers\Auth as AuthUser;
use App\helpers\Session;

class Document extends Basecontroller {

    protected $pagination;
    protected $permission;
    protected $sess;
    protected $docModel;
    protected $folderModel;
    protected $basePath;
    protected $model;
    protected $user;

    public function __construct() {
        parent::__construct();
        $this->docModel     = new Document_model;
        $this->folderModel  = new Folder_model;
        $this->sess         = new Session;
        $this->pagination   = new Pagination();
        $this->permission   = new checkPermissions();
        $this->basePath     = dirname(dirname(__DIR__))."/storage/docs";
        $this->model        = new Sippy_model();
        $this->user         = new User($this->sess->get('userid'));
    }

    /**
     * @param $id
     */
    public function folderd($id) {
        if (!AuthUser::logged_in()) $this->redirect('auth/login');

        $user = new User($this->sess->get('userid'));
        $userData = $user->getUser();
        $folderName = $this->folderModel->getFolderName($id);

        $this->Capsule::table('folders')->where('id', $id)->delete();
        // delete folder / roles link
        $this->Capsule::table('folders_roles')->where('folders_id1', $id)->delete();
        // delete documents
        $docIds = $this->docModel->getDocumentIds($id); // array of IDS
        $this->docModel->deleteDocumentByFolder($id);
        // delete tags, accept array
        /** @var TYPE_NAME $docIds array */
        $this->Capsule::table('tags')->whereIn('doc_id', $docIds)->delete();


        $this->audit->create('folders', ['name' => $folderName->name, 'user' => $userData->name, 'action' => 'folder deleted', 'created_at' => date('Y-m-d H:i:s')]);

        $this->flash->message('success', "Folder deleted");
        $this->redirect('main/dashboard');
    }

    public function docupload() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        $user = new User($this->sess->get('userid'));
        $userData = $user->getUser();
        // define filesizes
//        define('KB', 1024);
        define('MB', 1048576);
//        define('GB', 1073741824);
//        define('TB', 1099511627776);

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && $_POST['csrf'] === $this->sess->get('csrf_token')) {
            $backUrl = $_POST['backUrl'];
            $folderID = (int)$_POST['folderID'];
            $baseFileName = pathinfo($_FILES['file1']['name'])['filename'];
            $ext = pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION);

            $config = load_config();
            $dt = Carbon::parse(Carbon::now());
            // ex. 122017 folder name

            if (!empty($_FILES['file1']) && $_FILES['file1']['error'] === 0) {
                $tmp_name = $_FILES['file1']['tmp_name'];
                $file_name = $_FILES['file1']['name'];

                $new_name_base = md5(uniqid(mt_rand()));
                $new_name = $new_name_base.'.'.$ext;

                $folderName = $this->folderModel->createNewDocFolder($this->basePath, $dt->year, $dt->month);
                $path = $this->basePath . DIRECTORY_SEPARATOR . $folderName;
                $name = $path . DIRECTORY_SEPARATOR . $new_name;
                // $ext
                $success = '';
                if ($_FILES['file1']['size'] < $config['max_file_upload_size'] * MB) {
                    //mime check
                    $allowed_types = get_mimes();

                    if (in_array($_FILES['file1']['type'], $allowed_types)) {

                        $this->docModel->insertDocument('documents', array(
                            'folder_id' => $folderID,
                            'name' => $baseFileName,
                            'path' => $path,
                            'full_path' => $path . DIRECTORY_SEPARATOR . $new_name,
                            'http_path' => site_url() . 'storage/docs/' . $folderName,
                            'current_filename' => $new_name_base,
                            'original_filename' => $baseFileName,
                            'new_file_name' => $new_name_base,
                            'extension' => $ext,
                            'real_file' => 1,
                            'real_directory' => $dt->month . '-' . $dt->year,
                            'created_at' => date('Y-m-d H:i:s')
                        ));
                        $this->audit->create('documents',['doc_id'=>0,'name'=>$baseFileName,'user'=>$userData->name,'action'=>'document upload','created_at'=>date('Y-m-d H:i:s')]);
                        // ad to db
                        $success = move_uploaded_file($tmp_name, $name);
                    } else {
                        $this->flash->message('error', "This type of file can not be uploaded");
                        $this->redirect(site_url($backUrl) . DIRECTORY_SEPARATOR . $folderID);
                    }
                } else {
                    throw new \Exception("Error: File size may be too big" . $success);
                }

                // successs block
                if ($success) {
                    //message
                    $this->flash->message('success', "Document [$file_name] was Uploaded");
                    $this->redirect(site_url($backUrl) . DIRECTORY_SEPARATOR . $folderID);
                } else {
                    throw new \Exception("Error: " . $success);
                }

            } else {
                //error
                $this->flash->message('error',"Document could not be uploaded");
                logger("error","Error, this file cannot be uploaded, controller/Document.php - ".$_FILES['file1']['error'] .':'. __LINE__);
                $this->redirect(site_url($backUrl).DIRECTORY_SEPARATOR.$folderID);
            }
        }
    }

	
	public function viewall($docID) {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        //check permissions on folder ID
        $data['messSuccess'] = $this->flash->message('success');
        $data['messError'] = $this->flash->message('error');

        $userPerm = $this->user->getPermission();
        $permissions = app_permissions();
        // 'associate' 'super_admin'
        $data['viewRestrictions'] = (isset($permissions[$userPerm])) ? $permissions[$userPerm] : '';

//        echo msg('message_file_does_not_exist');

        $userID = $this->sess->get('userid');
        //create UI
        //redirect permission check callback
        $callbackUrl = site_url('main/dashboard');

        $control = $this->permission->check($userID, $docID, $callbackUrl);

        $data['uiMenu'] = $this->docModel->generateUIelements($control);
        $data['folder'] = $this->folderModel->getFolderName($docID);
        $data['folderID'] = $docID;
        $data['documents'] = $this->docModel->getDocumentsTags($docID);

        $this->View('document/view', $data);
	}

	public function getDocument() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        $userID = $this->sess->get('userid');
        $docID = (int)$_POST['document'];
        $folderID = (int)$_POST['folder'];
        $user = new User($userID);
        $userData = $user->getUser();

        $quickCheck = $this->permission->quickCheck($userID, $folderID, 'view');
        if ($quickCheck)
        {
            if (is_ajax_request())
            {
                $doc = $this->docModel->getDocument($docID);
                //audit log
                $this->audit->create('documents', ['doc_id' => $doc->id, 'name' => $doc->name . '.' . $doc->extension, 'user' => $userData->name, 'action' => 'document view', 'created_at' => date('Y-m-d H:i:s')]);

                if (file_exists($doc->full_path)) {

                    $mime = '';
                    $mimes = get_mimes();
                    $ext = (string)'.' . $doc->extension;
                    if (isset($mimes[$ext]) && $mimes[$ext]) {
                        $mime = $mimes[$ext];
                    }

                    header('Content-Type: application/json');
                    //var_dump($doc->http_path . $doc->current_filename . $ext);
                    echo json_encode([
                        'urlpath' => $doc->http_path .DIRECTORY_SEPARATOR. $doc->current_filename . $ext,
                        'ext' => $ext,
                        'mime' => $mime,
                        'extension' => $doc->extension
                    ]);

                } else {
                    logger("error", "Error, this file cannot be found " . __LINE__);
                }
            }
        }
    }

	public function viewit() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        $userID = $this->sess->get('userid');
        $docID = (int)$_GET['doc'];
        $folderID = (int)$_GET['fold'];
        $user = new User($userID);
        $userData = $user->getUser();

//        var_dump($docID);
//        var_dump($folderID);


        $quickCheck = $this->permission->quickCheck($userID, $folderID, 'view');
        if ($quickCheck) {
            $doc = $this->docModel->getDocument($docID);
            //audit log
            $this->audit->create('documents',['doc_id'=>$docID,'name'=>$doc->name.'.'.$doc->extension,'user'=>$userData->name,'action'=>'document view']);
//            pretty($doc);
            if (file_exists($doc->full_path)) {

                $mime = '';
                $mimes = get_mimes();
                $ext = (string)'.'.$doc->extension;
                if (isset($mimes[$ext]) && $mimes[$ext]) {
                    $mime = $mimes[$ext];
                }

                //veiwable types
                $viewableTypes = ['.pdf','.jpg'];
                if (! in_array($ext, $viewableTypes)) {
                    die("This type of document ($ext) can't be previewed. Please close this tab");
                }

                // send headers to browser to initiate file download
                header('Content-Length: '.filesize($doc->full_path));
                // Pass the mimetype so the browser can open it
                header('Cache-control: private');
                header('Content-Type: ' .  $mime);
                header('Content-Disposition: inline; filename="' . rawurlencode($doc->original_filename .'.'. $doc->extension) . '"');
                // Apache is sending Last Modified header, so we'll do it, too
                $modified=filemtime($doc->full_path);
                header('Last-Modified: '. date('D, j M Y G:i:s T', $modified));   // something like Thu, 03 Oct 2002 18:01:08 GMT

                readfile($doc->full_path);

            } else {
                logger("error","Error, this file cannot be found, controllers/Document.php ".__LINE__);
                //throw new \Exception('Error, this file cannot be found');
            }
        }
    }

    public function delete() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['csrf'] === $this->sess->get('csrf_token')) {
            $userID = $this->sess->get('userid');
            $docID = (int)$_POST['docID'];
            $folderID = (int)$_POST['folderID'];
            $user = new User($userID);
            $userData = $user->getUser();
            //get document folder id, select query

            $document = $this->docModel->getDocument($docID);
            $quickCheck = $this->permission->quickCheck($userID, $folderID, 'delete');
            if ($quickCheck) {
                //delete logic here
                //echo 'perform delete on '.$docID;
                $res = $this->docModel->deleteDocument($docID);
                //audit log
                $this->audit->create('documents',['doc_id'=>$docID,'name'=>$document->name.'.'.$document->extension,'user'=>$userData->name,'action'=>'document delete','created_at'=>date('Y-m-d H:i:s')]);
                if ($res) {
                    $this->flash->message('error',"Document was deleted");
                    $this->redirect(site_url('document/viewall').DIRECTORY_SEPARATOR.$folderID);
                }
            }

        }
    }

    public function download() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['csrf'] === $this->sess->get('csrf_token')) {
            $userID = $this->sess->get('userid');
            $docID = (int)$_POST['docID'];
            $folderID = (int)$_POST['folderID'];
            $user = new User($userID);
            $userData = $user->getUser();
            $document = $this->docModel->getDocument($docID);

            $quickCheck = $this->permission->quickCheck($userID, $folderID, 'download');
            //audit log
            $this->audit->create('documents',['doc_id'=>$docID,'name'=>$document->name.'.'.$document->extension,'user'=>$userData->name,'action'=>'document download','created_at'=>date('Y-m-d H:i:s')]);

            if ($quickCheck) {
                //download action
                $doc = $this->docModel->getDocument($docID);
                $this->do_download($doc);

                if (isset($folderID)) {
                    $this->redirect(site_url('document/viewall').$folderID);
                } else {
                    $this->redirect(site_url('main/dashboard'));
                }

            }

        }
    }

    public function do_download($doc) {
        $mime = '';
        $mimes = get_mimes();
        $ext = (string)'.'.$doc->extension;
        if (isset($mimes[$ext]) && $mimes[$ext]) {
            $mime = $mimes[$ext];
        }
        if (file_exists($doc->full_path)) {
            header('Cache-control: private');
            header('Content-Type: ' . $mime);
            header('Content-Disposition: attachment; filename="' . $doc->original_filename . '.' . $doc->extension . '"');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            readfile($doc->full_path);
        } else {
            //log
            logger("error","Error, this file cannot be found, controllers/Document.php ".__LINE__);
            //throw new \Exception('Error, this file cannot be found');
        }
    }

    public function copyview($id) {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');

        $data['docID'] = (int)$id;
        $document = $this->docModel->getDocument((int)$id);
        //d($document);
        $data['document'] = $document;
        $data['folderNames'] = $this->folderModel->getFolderNames();
        //d($data['folderNames']);
        $data['folderID'] = $document->folder_id;

        $this->View('document/copyview', $data);
    }

    public function copy() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['csrf'] === $this->sess->get('csrf_token')) {
            $userID = $this->sess->get('userid');
            $docID = (int)$_POST['docID'];
            $folderID = (int)$_POST['folderID'];
            $copyToFolder = $_POST['copyToFolder'];
            $backUrl = $_POST['backUrl'];
            $user = new User($userID);
            $userData = $user->getUser();
            $document = $this->docModel->getDocument($docID);

            //audit log
            $this->audit->create('documents',['doc_id'=>$docID,'name'=>$document->name.'.'.$document->extension,'user'=>$userData->name,'action'=>'document copy','created_at'=>date('Y-m-d H:i:s')]);

            $quickCheck = $this->permission->quickCheck($userID, $folderID, 'copy');
            if ($quickCheck) {
                // get document url from DB
                $document = $this->docModel->getDocument((int)$docID);
                // copy physical file and get copied location copy()
                $this->copyDocument($document,$copyToFolder);
                $ccFolder = $this->folderModel->getFolderName($copyToFolder);
                $this->flash->message('success',"File [$document->original_filename] copied to <a href='".site_url('document/viewall').DIRECTORY_SEPARATOR.$ccFolder->id."'>here</a>!");
                $this->redirect(site_url($backUrl).DIRECTORY_SEPARATOR.$folderID);
                // insert the copied full path to db with new $copyToFolder id as folder_id, and also append "Copy" to name
                //
            }
        }
    }

    private function copyDocument($document,$copyToFolderID) {
        //create new name and put together new file path
        $new_filename = $document->current_filename .'_'. mt_rand();
        $new_filename_with_ext = $new_filename.'.'.$document->extension;
        $newFile = $document->path.DIRECTORY_SEPARATOR.$new_filename_with_ext;

        if (! copy($document->full_path, $newFile)) {
            //log
            logger("error","Error, failed to copy $document->name, controllers/Document.php ".__LINE__);
        }
        //insert new document into DB
        $doc = array(
            'folder_id' => $copyToFolderID,
            'name' => $document->name,
            'path' => $document->path,
            'full_path' => $newFile,
            'http_path' => $document->http_path,
            'current_filename' => $new_filename,
            'original_filename' => $document->original_filename,
            'new_file_name' => $new_filename,
            'extension' => $document->extension,
            'real_file' => 1,
            'created_at' => date("Y-m-d H:i:s")
        );
        return $this->docModel->insertDocument('documents', $doc);
    }

    public function update() {
        if(!AuthUser::logged_in()) $this->redirect('auth/login');
        $data = [
            'name' => $_POST['name'],
            'extension' => $_POST['extension']
        ];
        if ($this->model->_update('documents',$data, (int)$_POST['docid'])) {
            echo json_encode(['response'=>true,'text'=>"success"]);
        }
    }



}
?>
