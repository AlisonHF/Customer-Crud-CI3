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
            'rules' => 'required|min_length[11]|max_length[14]'
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

$config['error_messages'] = array(
    'min_length' => 'O campo {field} precisa de {param} ou mais caracteres!',
    'max_length' => 'O campo {field} recebe o máximo de {param} caracteres!',
    'valid_email' => 'Digite um {field} válido!',
    'required' => 'O campo {field} é obrigatório!',
    'exact_length' => 'O campo {field} precisa ter exatamente {param} caracteres!',
    'is_unique' => 'Esse e-mail já foi cadastrado, use outro!'
);
