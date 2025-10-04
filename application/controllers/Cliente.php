<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('Cliente_model', 'ClienteModel');
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
        $this->load->library('pagination');
        $this->load->helper(['format_cep', 'format_telefone', 'format_cpf_cnpj']);

        $config['base_url'] = site_url('cliente/index');
        $config['total_rows'] = $this->ClienteModel->count_all();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['clientes'] = $this->ClienteModel->get_limit($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

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

        else
        {
            $data['cliente'] = $this->ClienteModel->get_by_id($this->id_update);

            $view = $this->load->view('form', $data, TRUE);
            $this->load->view('layouts/main', ['content' => $view, 'title' => 'Editar usuário']);
        }

        
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