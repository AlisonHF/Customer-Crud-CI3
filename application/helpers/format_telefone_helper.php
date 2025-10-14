<?php

/**
 * Helper para formatar o telefone ao exibir na listagem
 * @param string $telefone telefone recebido
 * @return string Formatado
 */
function format_telefone(string $telefone)
{
    if (empty($telefone)){
        return '';
    }

    $formatted_telefone = substr_replace($telefone, '(', 0, 0);
    $formatted_telefone = substr_replace($formatted_telefone, ')', 3, 0);
    $formatted_telefone = substr_replace($formatted_telefone, ' ', 4, 0);

    if (strlen($formatted_telefone) > 13){
        $formatted_telefone = substr_replace($formatted_telefone, '-', 10, 0);
        return $formatted_telefone;
    }

    $formatted_telefone = substr_replace($formatted_telefone, '-', 9, 0);

    return $formatted_telefone;
}
