<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_users($limit, $offset) {
		$this->db->limit($limit, $offset);
		$query = $this->db->get('users');
		return $query->result();
	}


	public function get_total_users() {
        return $this->db->count_all('users');
    }

    public function adicionar($data) {
        $insert = $this->db->insert('users', $data);
        if ($insert) {
            return true; 
        } else {
            return false; 
        }
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }
    

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

	public function excluir($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('users');
        return $result; 
    }

}
