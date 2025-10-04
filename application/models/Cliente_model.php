<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {
    public function get()
    {
        return $this->db->get('clientes')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('clientes', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('clientes', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('clientes', ['id' => $id]);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('clientes', ['id' => $id])->row();
    }

    public function get_by_cpf_cnpj($cpf_cnpj)
    {
        return $this->db->get_where('clientes', ['cpf_cnpj' => $cpf_cnpj])->result_array();
    }

    public function get_by_email($email)
    {
        return $this->db->get_where('clientes', ['email' => $email])->result_array();
    }

    public function count_all()
    {
        return $this->db->count_all('clientes');
    }

    public function get_limit($limit, $offset=0)
    {
        return $this->db->get('clientes', $limit, $offset)->result();
    }
}
