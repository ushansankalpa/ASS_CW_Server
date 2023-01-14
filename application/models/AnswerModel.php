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


        // $this->db->select('*');
        // $this->db->from('answers');
        // $this->db->join('users', 'answers.user_id = users.user_id');
        // $query = $this->db->get_where('answers',array('question_id' => $question_id));
        
        // return $query->result_array();


        $this->db->select('answers.*, users.user_id, users.first_name, users.last_name,');
        $this->db->from('answers');
        $this->db->join('users', 'answers.user_id = users.user_id');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function createAnswer($data){
        $this->db->insert('answers', $data);
        return $this->db->affected_rows();
    }

    public function ansUpVote($id){
        $this->db->set('answer_votes', 'answer_votes+1', FALSE);
        $this->db->where('answer_id', $id);
        $this->db->update('answers');
        return $this->db->affected_rows();
    }

    public function getAnsUpvotes($id){
        $this->db->select('answer_vote');
        $this->db->from('answers');
        $this->db->where('answer_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}