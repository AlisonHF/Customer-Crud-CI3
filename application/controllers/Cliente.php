<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Cliente_model", "ClienteModel");
        $this->load->library('form_validation');
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

            $this->form_validation->set_rules(
                'nome',
                'Nome',
                'required|min_length[5]|max_length[255]',
            );

            $this->form_validation->set_rules(
                'cpf_cnpj',
                'CPF/CNPJ',
                'required|min_length[11]|max_length[14]'
            );

            $this->form_validation->set_rules(
                'email',
                'E-mail',
                'required|valid_email'
            );

            $this->form_validation->set_rules(
                'telefone',
                'Telefone',
                'min_length[8]|max_length[19]'
            );

            $this->form_validation->set_rules(
                'cep',
                'CEP',
                'required|exact_length[8]'
            );

            $this->form_validation->set_rules(
                'endereco',
                'Endereço',
                'required|min_length[10]|max_length[255]'
            );

            $this->form_validation->set_rules(
                'cidade',
                'Cidade',
                'required|min_length[5]|max_length[100]'
            );

            $this->form_validation->set_rules(
                'uf',
                'UF',
                'required|exact_length[2]'
            );

            $this->form_validation->set_message(array(
                    'min_length' => 'O campo {field} precisa de {param} ou mais caracteres!',
                    'max_length' => 'O campo {field} recebe o máximo de {param} caracteres!',
                    'valid_email' => 'Digite um {field} válido!',
                    'required' => 'O campo {field} é obrigatório!',
                    'exact_length' => 'O campo {field} precisa ter exatamente {param} caracteres!'
                )
            );

            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
                $this->ClienteModel->insert($data);

                redirect('Cliente');
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

			$this->ClienteModel->update($id, $data);
			redirect('Cliente');
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
}
