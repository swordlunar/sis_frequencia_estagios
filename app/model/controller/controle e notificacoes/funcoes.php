<?php
function periodo_letivo_atual()
{
    $ano_atual = date('Y');
    $mes_atual = date('m');

    if ($mes_atual > 6) {
        $periodo_letivo = $ano_atual . '2';
        // $mes_atual = 2;
    } else {
        // $mes_atual = 1;
        $periodo_letivo = $ano_atual . '1';
    }
    return $periodo_letivo;
}

function hoje(){
    date_default_timezone_set('America/Fortaleza');
    $hoje = date("Y-m-d H:i:s");
    return $hoje;
}