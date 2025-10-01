<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('Cliente_model', 'ClienteModel');
        $this->load->library('form_validation');
        $this->form_validation->set_message(array(
            'min_length' => 'O campo {field} precisa de {param} ou mais caracteres!',
            'max_length' => 'O campo {field} recebe o máximo de {param} caracteres!',
            'valid_email' => 'Digite um {field} válido!',
            'required' => 'O campo {field} é obrigatório!',
            'exact_length' => 'O campo {field} precisa ter exatamente {param} caracteres!',
            'is_unique' => 'Esse {field} já foi cadastrado, use outro!',
            )
        );
	}

	public function index()
	{
        $this->load->helper(['format_cep', 'format_telefone', 'format_cpf_cnpj']);

		$data['clientes'] = $this->ClienteModel->get();
        $view = $this->load->view('list', $data, TRUE);

        $this->load->view('layouts/main', ['content' => $view, 'title' => 'Lista de Clientes']);
	}

	public function insert()
	{
		if ($this->input->post())
		{
			
            $data = [
                'nome_razao' => trim(ucfirst($this->input->post('nome'))),
                'cpf_cnpj' => trim($this->input->post('cpf_cnpj')),
                'email' => trim($this->input->post('email')),
                'telefone' => trim($this->input->post('telefone')),
                'cep' => trim($this->input->post('cep')),
                'endereco' => trim(ucfirst($this->input->post('endereco'))),
                'cidade' => trim(ucfirst($this->input->post('cidade'))),
                'uf' => trim($this->input->post('uf')),
            ];

            if ($this->form_validation->run() !== FALSE)
            {
                $this->ClienteModel->insert($data);

                return redirect('Cliente?insert=true');
            }

            $view = $this->load->view('form', '', TRUE);
            $this->load->view('layouts/main', ['content' => $view]);
        } 

		else
		{
			$view = $this->load->view('form', '', TRUE);
			$this->load->view('layouts/main', ['content' => $view, 'title' => 'form cliente']);
		}
	}

	public function update($id)
    {
        $this->id_update = $id;

        if ($this->input->post())
		{
            $data = [
                'nome_razao' => trim(ucfirst($this->input->post('nome'))),
                'cpf_cnpj' => trim($this->input->post('cpf_cnpj')),
                'email' => trim($this->input->post('email')),
                'telefone' => trim($this->input->post('telefone')),
                'cep' => trim($this->input->post('cep')),
                'endereco' => trim(ucfirst($this->input->post('endereco'))),
                'cidade' => trim(ucfirst($this->input->post('cidade'))),
                'uf' => trim($this->input->post('uf'))
            ];
            
            $search_cpf_cnpj = $this->ClienteModel->get_by_cpf_cnpj($data['cpf_cnpj']);

            if($this->form_validation->run() !== FALSE)
            {
                $this->ClienteModel->update($this->id_update, $data);
                return redirect('Cliente?update=true');
            }
            
            $data['cliente'] = $this->ClienteModel->get_by_id($this->id_update);

            $view = $this->load->view('form', $data, TRUE);
            $this->load->view('layouts/main', ['content' => $view, 'cliente' => $this->ClienteModel->get_by_id($this->id_update)]);
        }

        $data['cliente'] = $this->ClienteModel->get_by_id($this->id_update);

        $view = $this->load->view('form', $data, TRUE);
        $this->load->view('layouts/main', ['content' => $view, 'title' => 'Editar usuário']);
    }

    public function delete($id) 
	{
        $this->ClienteModel->delete($id);

        redirect('Cliente?delete=true');
	}

    // Rules 

    public function check_cpf_cnpj_update($value)
    {
        $id = $this->id_update;
        
        $search_cpf_cnpj = $this->ClienteModel->get_by_cpf_cnpj($value);

        foreach ($search_cpf_cnpj as $c) {
            if ($c['id'] != $id) {
                $this->form_validation->set_message('check_cpf_cnpj_update', 'CPF/CNPJ já está em uso!');
                return false;
            }
        }

        return true;
    }

    public function check_email($email)
    {
        $id = $this->id_update;

        $search_email = $this->ClienteModel->get_by_email($email);

        foreach($search_email as $e)
        {
            if ($e['id'] != $id)
            {
                $this->form_validation->set_message('check_email', 'Esse E-mail já foi cadastrado, use outro!');
                return false;
            }
        }

        return true;
    }
}