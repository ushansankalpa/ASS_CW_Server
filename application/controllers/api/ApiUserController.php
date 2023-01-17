<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

require APPPATH . '/libraries/REST_Controller.php';

class ApiUserController extends Rest_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index_get($id){

        $users = $this->UserModel->getUsers($id);
        if($users){
            $this->response([
                'status' => true,
                'data' => $users
            ], Rest_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    }

    public function register_post(){
        $hashed_password = password_hash($this->post('password'),PASSWORD_DEFAULT);
        $data = [
            'first_name' => $this->post('first_name'),
            'last_name' => $this->post('last_name'),
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'password' => $hashed_password
        ];
        if($this->UserModel->createUser($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'new user has been created'
            ], Rest_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed to create new data'
            ], Rest_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put($id){
        $data = [
            'first_name' => $this->put('first_name'),
            'last_name' => $this->put('last_name'),
            'username' => $this->put('username'),
            'email' => $this->put('email'),
            'password' => $this->put('password')
        ];
        if($this->UserModel->updateUser($data, $id) ){
            $this->response([
                'status' => true,
                'message' => 'data has been updated'
            ], Rest_Controller::HTTP_NO_CONTENT);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], Rest_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete($id){
        if($id == null){
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], Rest_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->UserModel->deleteUser($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], Rest_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], Rest_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function login_post() {
        $email = $this->post('email');
        $password = $this->post('password');
        
        if(!empty($email) && !empty($password)){
           
        
            $user = $this->UserModel->authenticate($email,$password);
            if($user){
                $data = $this->UserModel->getAuthUserId($email, $password);
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $data[0]
                ], REST_Controller::HTTP_OK);
            }else{
                
                $this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response("Provide email and password.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}