<?php

function format_telefone($telefone)
{
    if (empty($telefone))
    {
        return '';
    }

    $formatted_telefone = substr_replace($telefone, '(', 0, 0);
    $formatted_telefone = substr_replace($formatted_telefone, ')', 3, 0);
    $formatted_telefone = substr_replace($formatted_telefone, ' ', 4, 0);
    $formatted_telefone = substr_replace($formatted_telefone, '-', 10, 0);

    return $formatted_telefone;
}
