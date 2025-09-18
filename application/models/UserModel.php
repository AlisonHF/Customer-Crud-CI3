<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get('user')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('user', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('user', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('user', $data);
    }

    public function delete($id) {
        return $this->db->delete('user', ['id' => $id]);
    }
}
