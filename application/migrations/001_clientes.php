<?php

defined('BASEPATH') OR exit('No direct script acecess allowed!');

class Migration_clientes extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],

            'nome_razao' => [
                'type' => 'varchar',
                'constraint' => 256, 
                'null' => FALSE
            ],

            'cpf_cnpj' => [
                'type' => 'varchar',
                'constraint' => 14,
                'null' => FALSE
            ],

            'email' => [
                'type' => 'varchar',
                'constraint' => 256,
                'null' => FALSE
            ],

            'telefone' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => TRUE
            ],

            'cep' => [
                'type' => 'varchar',
                'constraint' => 8,
                'null' => FALSE
            ],

            'endereco' => [
                'type' => 'varchar',
                'constraint' => 256,
                'null' => FALSE
            ],

            'cidade' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => FALSE
            ],

            'uf' => [
                'type' => 'varchar',
                'constraint' => 2,
                'null' => FALSE
            ]
        ]);
    }

    public function down() {
        $this->dbforge->drop_table('clientes');
    }
}