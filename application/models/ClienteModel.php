<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClienteModel extends CI_Model {

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

    /**
     * Realiza a contagem dos cadastros na tabela clientes
     * Necessário para a configuração $config['total_rows'] da lib pagination
     */
    public function count_all()
    {
        return $this->db->count_all('clientes');
    }

    /**
     * Recupera os dados da tabela conforme o limit e offset passado
     * Necessário para a lib pagination
     * @param int $limit Até qual indice será buscado no banco
     * @param int @offset Por qual indice irá começar
     */
    public function get_limit(int $limit, int $offset=0)
    {
        return $this->db->get('clientes', $limit, $offset)->result();
    }
}
