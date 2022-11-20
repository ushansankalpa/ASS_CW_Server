<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ApiAnswerController extends Rest_Controller{
    public function __construct(){
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
            'question_id' => $question_id,
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
}