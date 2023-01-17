<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ApiAnswerController extends Rest_Controller{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('AnswerModel');
    }

    public function index_get($question_id){
        $answers = $this->AnswerModel->getAnswers($question_id);
        if($answers){
            $this->response([
                'status' => true,
                'data' => $answers
            ], Rest_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post($question_id){
        $data = [
            'answer_des' => $this->post('answer_des'),
            'answer_img' => $this->post('answer_img'),
            'answer_votes' => 0,
            'question_id' => $question_id,
            'user_id' => $this->post('user_id'),
        ];
        $res = $this->AnswerModel->createAnswer($data);
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

    public function ansUpVote_put($id){        
        if($this->AnswerModel->ansUpVote($id) > 0){
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

    public function ansUpVote_get(){
        $votes = $this->AnswerModel->getAnsUpvotes();
        if($votes){
            $this->response([
                'status' => true,
                'data' => $votes
            ], Rest_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    }
}