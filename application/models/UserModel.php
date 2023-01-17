<?php

class UserModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }
    
    public function getUsers($id){
        $query = $this->db->get_where('users',array('user_id' => $id));
        return $query->result_array();
    }

    public function createUser($data){
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function updateUser($data, $id){
        $this->db->where('user_id', $id);
        return  $this->db->update('users', $data);
    }

    public function deleteUser($id){
        $this->db->delete('users', ['user_id' => $id]);
        return $this->db->affected_rows();
    }

    function authenticate($email,$password)
    {
        $res = $this->db->get_where('users',array('email' => $email));
        if ($res->num_rows() != 1) {
            return false;
        }
        else {
            $row = $res->row();
            if (password_verify($password,$row->password)) {
                return true;
            }
            else {
                return false;
            }
        }
    }

    function getAuthUserId($email,$password)
    {
        $res = $this->db->get_where('users',array('email' => $email));
		return $res->result_array();
    }
}