<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class ApiBookmarkController extends Rest_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('BookmarkModel');
    }

    public function find_get($user_id) {

        $bookmark = $this->BookmarkModel->get_bookmarked_questions($user_id);
        if($bookmark){
            $this->response([
                'status' => true,
                'data' => $bookmark
            ], Rest_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    
    }

    public function add_post($question_id,$user_id) {


        $res = $this->BookmarkModel->add_bookmark($question_id, $user_id);
        if($res > 0){
            $this->response([
                'status' => true,
                'data' => $res
            ], Rest_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    }

    public function remove($question_id,$user_id) {
        $this->BookmarkModel->remove_bookmark($question_id, $user_id);
    }

    
}