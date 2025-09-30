<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct() {
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
		$data['clientes'] = $this->ClienteModel->get();
        $view = $this->load->view('list', $data, TRUE);
        $this->load->view('layouts/main', ['content' => $view, 'title' => 'Lista de Clientes']);
	}

	public function insert(): void
	{
		if ($this->input->post())
		{
			
            $data = [
                'nome_razao' => $this->input->post('nome'),
                'cpf_cnpj' => $this->input->post('cpf_cnpj'),
                'email' => $this->input->post('email'),
                'telefone' => $this->input->post('telefone'),
                'cep' => $this->input->post('cep'),
                'endereco' => $this->input->post('endereco'),
                'cidade' => $this->input->post('cidade'),
                'uf' => $this->input->post('uf'),
            ];

            $this->form_validation->set_message($this->config->item('error_messages'));
            
            if ($this->form_validation->run() == FALSE)
            {
                $view = $this->load->view('form', '', TRUE);
                $this->load->view('layouts/main', ['content' => $view]);
            }
            else
            {
                $this->ClienteModel->insert($data);
                redirect('Cliente?insert=true');
            }
        } 

		else
		{
			$view = $this->load->view('form', '', TRUE);
			$this->load->view('layouts/main', ['content' => $view, 'title' => 'form cliente']);
		}
	}
	public function update($id) {
        if ($this->input->post())
		{

            $data = [
                'nome_razao' => $this->input->post('nome'),
                'cpf_cnpj' => $this->input->post('cpf_cnpj'),
                'email' => $this->input->post('email'),
                'telefone' => $this->input->post('telefone'),
                'cep' => $this->input->post('cep'),
                'endereco' => $this->input->post('endereco'),
                'cidade' => $this->input->post('cidade'),
                'uf' => $this->input->post('uf'),
            ];

            
            $search_cpf_cnpj = $this->ClienteModel->get_by_cpf_cnpj($data['cpf_cnpj']);
            $duplicated_cpf_cnpj = false;

            if (!empty($search_cpf_cnpj))
            {
                foreach($search_cpf_cnpj as $c)
                {
                    if($c['id'] != $id)
                    {
                        $duplicated_cpf_cnpj = true;
                    }
                };
            }

            if($this->form_validation->run() == FALSE)
            {
                $view = $this->load->view('form', '', TRUE);
                $this->load->view('layouts/main', ['content' => $view]);
            }
            else
            {
                $this->ClienteModel->update($id, $data);
			    redirect('Cliente?update=true');
            }
        }

		else 
		{
            $data['cliente'] = $this->ClienteModel->get_by_id($id);
            $view = $this->load->view('form', $data, TRUE);
            $this->load->view('layouts/main', ['content' => $view, 'title' => 'Editar usuário']);
        }
    }

    public function delete($id) 
	{
        $this->ClienteModel->delete($id);
        redirect('Cliente');
	}

    public function _always_false()
    {
        return false;
    }
}
