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


            if($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
                $this->ClienteModel->update($id, $data);

			    redirect('Cliente');
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
}
