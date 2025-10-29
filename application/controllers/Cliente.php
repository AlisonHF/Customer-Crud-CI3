<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller cliente
 */
class Cliente extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('ClienteModel');
        $this->form_validation->set_message(array(
            'min_length'    => 'O campo {field} precisa de {param} ou mais caracteres!',
            'max_length'    => 'O campo {field} recebe o máximo de {param} caracteres!',
            'valid_email'   => 'Digite um {field} válido!',
            'required'      => 'O campo {field} é obrigatório!',
            'exact_length'  => 'O campo {field} precisa ter exatamente {param} caracteres!',
            'is_unique'     => 'Esse {field} já foi cadastrado, use outro!',
            )
        );
	}

    /**
     * Página inicial
     */
	public function index()
	{
        $this->load->library('pagination');
        $this->load->helper(['format_cep', 'format_telefone', 'format_cpf_cnpj']);

        /**
         * Configurações do helper Pagination
         */
        $config = [
            'base_url'          => site_url('cliente/index'),
            'total_rows'        => $this->ClienteModel->count_all(),
            'per_page'          => 5,
            'uri_segment'       => 3,
            'full_tag_open'     => '<ul class="pagination">',
            'full_tag_close'    => '</ul>',
            'first_link'        => 'Primeiro',
            'last_link'         => 'Último',
            'next_link'         => 'Próximo',
            'prev_link'         => 'Anterior',
            'cur_tag_open'      => '<li class="active"><a href="#">',
            'cur_tag_close'     => '</a></li>',
            'num_tag_open'      => '<li>',
            'num_tag_close'     => '</li>'
        ];

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['clientes'] = $this->ClienteModel->get_limit($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $view = $this->load->view('list', $data, TRUE);

        $this->load->view('layouts/main', ['content' => $view, 'title' => 'Lista de Clientes']);
	}

    /**
     * Página de inserção de clientes
     */
	public function insert()
	{
		if ($this->input->post()) {
			
            $data = [
                'nome_razao'    => trim(ucfirst($this->input->post('nome'))),
                'cpf_cnpj'      => trim($this->input->post('cpf_cnpj')),
                'email'         => trim($this->input->post('email')),
                'telefone'      => str_replace(['(', ')', '-'], '', trim($this->input->post('telefone'))),
                'cep'           => str_replace('-', '', trim($this->input->post('cep'))),
                'endereco'      => trim(ucfirst($this->input->post('endereco'))),
                'cidade'        => trim(ucfirst($this->input->post('cidade'))),
                'uf'            => trim($this->input->post('uf')),
            ];

            if ($this->form_validation->run() !== FALSE)
            {
                $this->ClienteModel->insert($data);
                return redirect('Cliente?insert=true');
            }

            $view = $this->load->view('form', '', TRUE);
            $this->load->view('layouts/main', ['content' => $view]);
        } else {
			$view = $this->load->view('form', '', TRUE);
			$this->load->view('layouts/main', ['content' => $view, 'title' => 'form cliente']);
		}
	}

    /**
     * Página de edição
     */
	public function update(int $id)
    {
        $this->id_update = $id;

        if ($this->input->post()) {
            $data = [
                'nome_razao'    => trim(ucfirst($this->input->post('nome'))),
                'cpf_cnpj'      => trim($this->input->post('cpf_cnpj')),
                'email'         => trim($this->input->post('email')),
                'telefone'      => str_replace(['(', ')', '-'], '', trim($this->input->post('telefone'))),
                'cep'           => str_replace('-', '', trim($this->input->post('cep'))),
                'endereco'      => trim(ucfirst($this->input->post('endereco'))),
                'cidade'        => trim(ucfirst($this->input->post('cidade'))),
                'uf'            => trim($this->input->post('uf'))
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
        } else {
            $data['cliente'] = $this->ClienteModel->get_by_id($this->id_update);

            $view = $this->load->view('form', $data, TRUE);
            $this->load->view('layouts/main', ['content' => $view, 'title' => 'Editar usuário']);
        }
    }

    /**
     * Página de exclusão
     */
    public function delete(int $id) : mixed
	{
        $this->ClienteModel->delete($id);

        redirect('Cliente?delete=true');
	}

    /**
     * Função de callback para checagem do CPF/CNPJ ao editar um cadastro
     * @param string $cpf_cnpj Recebe o CPF/CNPJ digitado
     * @return bool
     */
    public function check_cpf_cnpj_update(string $cpf_cnpj) : bool
    {
        $id = $this->id_update;
        
        $search_cpf_cnpj = $this->ClienteModel->get_by_cpf_cnpj($cpf_cnpj);

        foreach ($search_cpf_cnpj as $c) {
            if ($c['id'] != $id) {
                $this->form_validation->set_message('check_cpf_cnpj_update', 'CPF/CNPJ já está em uso!');
                return false;
            }
        }
        return true;
    }

    /**
     * Função de callback para checar se o e-mail já foi usado ao editar um cadastro
     * @param string $email Recebe o e-mail do usuário
     * @return bool
     */
    public function check_email(string $email) : bool
    {
        $id = $this->id_update;

        $search_email = $this->ClienteModel->get_by_email($email);

        foreach($search_email as $e) {
            if ($e['id'] != $id)
            {
                $this->form_validation->set_message('check_email', 'Esse E-mail já foi cadastrado, use outro!');
                return false;
            }
        }
        
        return true;
    }

    /**
     * Função de callback que verifica se o tamanho da string recebida corresponde a um CPF ou CNPJ
     * @param string $cpf_cnpj Recebe a string
     * @return bool
     */
    public function check_length_cpf_cnpj(string $cpf_cnpj) : bool
    {
        if (strlen($cpf_cnpj) === 11 || strlen($cpf_cnpj) === 14)
        {
            return true;
        }
        
        $this->form_validation->set_message('check_length_cpf_cnpj', 'O campo deve conter 11 ou 14 caracteres!');
        return false;
    }
}
