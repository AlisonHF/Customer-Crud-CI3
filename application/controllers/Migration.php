<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para chamar as migrations caso necessário
 */
class Migration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index()
    {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo 'Migrations executadas com sucesso!';
        }
    }

}
