<?php

/**
 * Helper para formatar o CEP ao exibir na listagem
 * @param string $cep CEP recebido
 * @return string Formatado
 */
function format_cep(string $cep)
{
    $formatted_cep = substr_replace($cep, '-', 5, 0);

    return $formatted_cep;
}
