<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TaskModel;


class Home extends BaseController
{
    public function taskcomplete($id=null){
         $taskmodel = new TaskModel();
         if ($id!='') {
            $tasksave=$taskmodel->update($id, ['completed'=>1]);
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(200, 'Task has been completed.');
            return $this->response->setJSON(['success'=>1, 'msg'=>'Task has been completed']);
        }
        $this->response->setContentType('application/json');
            $this->response->setStatusCode(400, 'Internal error.');
            return $this->response->setJSON(['success'=>1, 'msg'=>'Please try again']);
    }
    public function taskdelete($id=null){
         $taskmodel = new TaskModel();
         if ($id!='') {
                $tasksave=$taskmodel->delete($id);
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(200, 'Task has been deleted.');
            return $this->response->setJSON(['success'=>1, 'msg'=>'Task has been deleted']);
        }
        $this->response->setContentType('application/json');
            $this->response->setStatusCode(400, 'Internal error.');
            return $this->response->setJSON(['success'=>1, 'msg'=>'Please try again']);
    }
    public function tasksave(){
        $session = session();
        if ($this->request->isAJAX()) {
             $rules = [
            'title'          => 'required',
            'description'         => 'required',
            'duedate'      => 'required|min_length[4]|max_length[50]',
            ];

            if (!$this->validate($rules)) {
                $this->response->setContentType('application/json');
                $this->response->setStatusCode(400, 'Please fill required fileds');
                return $this->response->setJSON($this->validator->getErrors());
            }
            $taskmodel = new TaskModel();
            
            

            $data = [
                'title'     => $this->request->getPost('title'),
                'description'     => $this->request->getPost('description'),
                'due_date'     => $this->request->getPost('duedate'),
                'user_id'     => $session->get('user_id'),
                
            ];
            if ($this->request->getPost('taskid')!='') {
                $tasksave=$taskmodel->update($this->request->getPost('taskid'), $data);
            }else{
               $tasksave=$taskmodel->save($data);
            }
            
            
          
             if ($tasksave) {
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(200, 'task saved successfully.');
            return $this->response->setJSON(['success'=>1, 'msg'=>'Task saved successfully.']);
            }else{
                    $this->response->setContentType('application/json');
                $this->response->setStatusCode(400);
                return $this->response->setJSON(['success'=>0, 'msg'=>'Please try agian']);
            } 
        }
    }
    public function index()
    {

        return view('task');
    }


    public function login()
    {       
        echo view('login');
    }

    public function loginProccess()
    {
        $rules = [
            'email'         => 'required|min_length[4]|max_length[100]|valid_email',
            'password'      => 'required|min_length[4]|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(400, 'Following fields are required');
            return $this->response->setJSON($this->validator->getErrors());
        }

        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $userData = $model->where('email', $email)->first();
        $pass = $userData['password'];
        if($userData && password_verify($password, $pass)){
            
                $ses_data = [
                    'user_id'       => $userData['id'],
                    'user_name'     => $userData['full_name'],
                    'user_email'    => $userData['email'],
                    'logged_in'     => TRUE
                ];
                 $session->set($ses_data);
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(200, 'Login successfully');
            return $this->response->setJSON(['success'=>1, 'msg'=>'Login successfully.']);
           
        }else{
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(400, 'Invalid credientials');
            return $this->response->setJSON([]);
        }
    }
  

     public function register()
    {
        
        $data = [];
        echo view('register', $data);
    }
  
    public function registerStore()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        helper(['form']);
        $rules = [
            'full_name'          => 'required|min_length[2]|max_length[100]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(400, 'Following fields are required');
            return $this->response->setJSON($this->validator->getErrors());
        }
          
 
            $userModel = new UserModel();

            $data = [
                'full_name'     => $this->request->getVar('full_name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
                $user=$userModel->save($data);
        if ($user) {
            $this->response->setContentType('application/json');
            $this->response->setStatusCode(200, 'User registered successfully.');
            return $this->response->setJSON(['success'=>1, 'msg'=>'user registered successfully.']);
        }else{
                $this->response->setContentType('application/json');
            $this->response->setStatusCode(400);
            return $this->response->setJSON(['success'=>0, 'msg'=>'Please try agian']);
        }      
     
        
          
    }

    public function taskList(){
        $session = session();
         $taskmodel = new TaskModel();
         $tasks=$taskmodel->where('user_id', $session->get('user_id'))->orderBy('id', 'desc')->findAll();
        $this->response->setContentType('application/json');
        $this->response->setStatusCode(200, 'task list');
        return $this->response->setJSON(['success'=>1, 'data'=>$tasks]);
    }
    public function taskform($id=null)
    {
        $formdata=[];
        if ($id > 0) {
            $taskmodel = new TaskModel();
            $formdata = $taskmodel->where('id', $id)->first();
        }
       
        
        return view('_taskForm', ['formdata'=>$formdata]);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
  
  
}
