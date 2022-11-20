<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class ApiQuestionController extends Rest_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('QuestionModel');
    }

    public function index_get(){
        $questions = $this->QuestionModel->getQuestions();
        if($questions){
            $this->response([
                'status' => true,
                'data' => $questions
            ], Rest_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post($id){
        $data = [
            'question_title' => $this->post('question_title'),
            'question_des' => $this->post('question_des'),
            'question_img' => $this->post('question_img'),
            'id' => $id,
        ];
        $res = $this->QuestionModel->createQuestion($data);
        if( $res > 0){
            $this->response([
                'status' => true,
                'data' => $data
            ], Rest_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed to create new data'
            ], Rest_Controller::HTTP_BAD_REQUEST);
        }
    }

    // public function index_put($id){
    //     $data = [
    //         'first_name' => $this->put('first_name'),
    //         'last_name' => $this->put('last_name'),
    //         'username' => $this->put('username'),
    //         'email' => $this->put('email'),
    //         'password' => $this->put('password')
    //     ];
    //     if($this->UserModel->updateUser($data, $id) ){
    //         $this->response([
    //             'status' => true,
    //             'message' => 'data has been updated'
    //         ], Rest_Controller::HTTP_NO_CONTENT);
    //     }else{
    //         $this->response([
    //             'status' => false,
    //             'message' => 'failed to update data'
    //         ], Rest_Controller::HTTP_BAD_REQUEST);
    //     }
    // }

    public function index_delete($id){
        if($id == null){
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], Rest_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->QuestionModel->deleteQuestion($id) > 0){
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
}