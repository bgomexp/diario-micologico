<?php

function writtenDate($fecha)
{
    $numerosFecha = explode("-", $fecha);
    $resultado = $numerosFecha[0] . " de ";
    $meses = [
        '01' => 'enero', '02' => 'febrero', '03' => 'marzo',
        '04' => 'abril', '05' => 'mayo', '06' => 'junio',
        '07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
        '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre',
    ];
    $resultado .= $meses[$numerosFecha[1]] . " de " . $numerosFecha[2];
    return $resultado;
}