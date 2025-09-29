<?php

$config = array(
    'Cliente/insert' => array(

        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|min_length[5]|max_length[255]'
        ),

        array(
            'field' => 'cpf_cnpj',
            'label' => 'CPF/CNPJ',
            'rules' => 'required|min_length[11]|max_length[14]|is_unique[clientes.cpf_cnpj]'
        ),

        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email|is_unique[clientes.email]'
        ),

        array(
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'min_length[8]|max_length[19]'
        ),

        array(
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'required|exact_length[8]'
        ),

        array(
            'field' => 'endereco',
            'label' => 'Endereço',
            'rules' => 'required|min_length[10]|max_length[255]'
        ),

        array(
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required|min_length[5]|max_length[100]'
        ),

        array(
            'field' => 'uf',
            'label' => 'UF',
            'rules' => 'required|exact_length[2]'
        ),       
    ),

    'Cliente/update' => array(

        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|min_length[5]|max_length[255]'
        ),

        array(
            'field' => 'cpf_cnpj',
            'label' => 'CPF/CNPJ',
            'rules' => 'required|min_length[11]|max_length[14]'
        ),

        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email'
        ),

        array(
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'min_length[8]|max_length[19]'
        ),

        array(
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'required|exact_length[8]'
        ),

        array(
            'field' => 'endereco',
            'label' => 'Endereço',
            'rules' => 'required|min_length[10]|max_length[255]'
        ),

        array(
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required|min_length[5]|max_length[100]'
        ),

        array(
            'field' => 'uf',
            'label' => 'UF',
            'rules' => 'required|exact_length[2]'
        ),
    )
);
