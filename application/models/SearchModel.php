<?php

class SearchModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }
    
    public function search($keyword){
        $this->db->join('users', 'questions.user_id = users.user_id');
        $this->db->like('question_title', $keyword);
        $this->db->or_like('question_des', $keyword);
        $query = $this->db->get('questions');
        $this->db->order_by('question_id', 'DESC');
        return $query->result_array();
    }
}
