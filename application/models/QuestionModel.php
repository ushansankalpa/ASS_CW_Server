<?php

class QuestionModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }
    
    public function getQuestions(){
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->order_by('question_id', 'DESC');
        $this->db->join('users', 'questions.user_id = users.user_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function createQuestion($data){
        $this->db->insert('questions', $data);
        return $this->db->affected_rows();
    }

    public function updateUser($data, $id){
        $this->db->where('questions_id', $id);
        return  $this->db->update('questions', $data);
    }

    public function deleteQuestion($id){
        $this->db->delete('questions', ['question_id' => $id]);
        return $this->db->affected_rows();
    }

    public function upVote($id){
        $this->db->set('question_votes', 'question_votes+1', FALSE);
        $this->db->where('question_id', $id);
        $this->db->update('questions');
        return $this->db->affected_rows();
    }

    public function profileQuestions($userId){

        $this->db->select('*');
        $this->db->from('questions');
        $this->db->join('users', 'questions.user_id = users.user_id');
        $this->db->where('questions.user_id', $userId);
        
        $query = $this->db->get();
        
        return $query->result_array();

    }
}