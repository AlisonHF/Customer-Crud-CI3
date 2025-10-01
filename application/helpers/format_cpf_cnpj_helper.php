<?php

function format_cpf_cnpj($cpf_cnpj)
{
    if (strlen($cpf_cnpj) === 11)
    {
        $formatted_cpf_cnpj = substr_replace($cpf_cnpj, '.', 3, 0);
        $formatted_cpf_cnpj = substr_replace($formatted_cpf_cnpj, '.', 7, 0);
        $formatted_cpf_cnpj = substr_replace($formatted_cpf_cnpj, '-', 11, 0);

        return $formatted_cpf_cnpj;
    }

    $formatted_cpf_cnpj = substr_replace($cpf_cnpj, '.', 2, 0);
    $formatted_cpf_cnpj = substr_replace($formatted_cpf_cnpj, '.', 6, 0);
    $formatted_cpf_cnpj = substr_replace($formatted_cpf_cnpj, '/', 10, 0);
    $formatted_cpf_cnpj = substr_replace($formatted_cpf_cnpj, '-', 15, 0);

    return $formatted_cpf_cnpj;

}

?>