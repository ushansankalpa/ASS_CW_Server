<?php

class AnswerModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getAnswers($question_id){
        // if($id === null){
        //     return $this->db->get('users')->result_array();
        // }else{
        //     return $this->db->get_where('users', ['id' => $id])->result_array();
        // }
        // $this->db->where('id', $id);
        $query = $this->db->get_where('aswers',array('question_id' => $question_id));
        return $query->result_array();
    }

    public function createAnswer($data){
        $this->db->insert('aswers', $data);
        return $this->db->affected_rows();
    }
}