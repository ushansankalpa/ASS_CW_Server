<?php

class QuestionModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }
    
    public function getQuestions(){
        // if($id === null){
        //     return $this->db->get('users')->result_array();
        // }else{
        //     return $this->db->get_where('users', ['id' => $id])->result_array();
        // }
        // $this->db->where('id', $id);
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->join('users', 'users.id = questions.id');
        $query = $this->db->get();

        //$query = $this->db->get('questions');
        return $query->result_array();
    }

    public function createQuestion($data){
        $this->db->insert('questions', $data);
        return $this->db->affected_rows();
    }

    public function updateUser($data, $id){
        $this->db->where('id', $id);
        //$this->db->update('users', $data, ['id' => $id]);
        return  $this->db->update('users', $data);
    }

    public function deleteQuestion($id){
        $this->db->delete('questions', ['question_id' => $id]);
        return $this->db->affected_rows();
    }
}