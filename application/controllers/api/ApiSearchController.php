<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class ApiSearchController extends Rest_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('SearchModel');
    }

    public function search_post(){
        $keyword = strip_tags($this->post('keyword'));
        $results = $this->Search_model->search($keyword);
        $this->response($results);
    }

    
}