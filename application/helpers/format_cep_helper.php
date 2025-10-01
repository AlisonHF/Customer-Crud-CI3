<?php

function format_cep($cep)
{
    $formatted_cep = substr_replace($cep, '-', 5, 0);

    return $formatted_cep;
}
