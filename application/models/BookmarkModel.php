<?php

class BookmarkModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    
    public function get_bookmarked_questions($user_id) {
        $this->db->select('questions.*');
        $this->db->from('bookmarks');
        $this->db->join('questions', 'questions.question_id = bookmarks.question_id');
        $this->db->where('bookmarks.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_bookmark($question_id, $user_id) {
        $data = array(
            'question_id' => $question_id,
            'user_id' => $user_id
        );
        $this->db->insert('bookmarks', $data);

        return $this->db->affected_rows();
    }

    public function remove_bookmark($question_id, $user_id) {
        $this->db->where('question_id', $question_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('bookmarks');
    }
}