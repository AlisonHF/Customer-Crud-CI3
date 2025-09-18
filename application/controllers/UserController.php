<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->helper(['form', 'url']);
        $this->load->database();
    }

    public function index() {
        $data['users'] = $this->UserModel->get_all();
        $view = $this->load->view('list', $data, TRUE);
        $this->load->view('layouts/main', ['content' => $view, 'title' => 'Lista de Usuários']);
    }

    public function create() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email')
            ];
            $this->UserModel->insert($data);
            redirect('UserController');
        } else {
            $view = $this->load->view('user_form', '', TRUE);
            $this->load->view('layouts/main', ['content' => $view, 'title' => 'Adicionar usuário']);
        }
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email')
            ];
            $this->UserModel->update($id, $data);
            redirect('UserController');
        } else {
            $data['user'] = $this->UserModel->get_by_id($id);
            $view = $this->load->view('user_form', $data, TRUE);
            $this->load->view('layouts/main', ['content' => $view, 'title' => 'Editar usuário']);
        }
    }

    public function delete($id) {
        $this->UserModel->delete($id);
        redirect('UserController');
    }
}
