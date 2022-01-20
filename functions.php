<?php

function posicionInicialUsuario(&$tablero) {
    $coordInicUsuario = [];
    $encontrado = false;
    while (!$encontrado) {
        $fila = rand(0, BOARD_SIZE - 1);
        $columna = rand(0, BOARD_SIZE - 1);
        if (empty($tablero[$fila][$columna])) {
            $tablero[$fila][$columna] = "*";
            $encontrado = true;
            $coordInicUsuario = [$fila, $columna];
        }
    }
    return $coordInicUsuario;
}

function posicionInicialCPU(&$tablero) {
    $coordInicCPU = [];
    $encontrado = false;
    while (!$encontrado) {
        $celdasAdyacLibres = true;
        $fila = rand(0, BOARD_SIZE - 1);
        $columna = rand(0, BOARD_SIZE - 1);
        if (empty($tablero[$fila][$columna])) {
            $fPrev = max(0, $fila - 1);
            $fPost = min(BOARD_SIZE - 1, $fila + 1);
            $cPrev = max(0, $columna - 1);
            $cPost = min(BOARD_SIZE - 1, $columna + 1);
            for ($f = $fPrev; $f <= $fPost; $f++) {
                for ($c = $cPrev; $c <= $cPost; $c++) {
                    if (!empty($tablero[$f][$c])) {
                        $celdasAdyacLibres = false;
                    }
                }
            }
            if ($celdasAdyacLibres) {
                $encontrado = true;
                $tablero[$fila][$columna] = "+";
                $coordInicCPU = [$fila, $columna];
            }
        }
    }
    return $coordInicCPU;
}

function comprobarJugadaUsuario($f, $c, $fInicio, $cInicio) {
    $valido = false;
    if (($f == $fInicio + 2 && $c == $cInicio + 1) || ($f == $fInicio + 2 && $c == $cInicio - 1) || ($f == $fInicio - 2 && $c == $cInicio + 1) ||
            ($f == $fInicio - 2 && $c == $cInicio - 1) || ($f == $fInicio + 1 && $c == $cInicio + 2) || ($f == $fInicio - 1 && $c == $cInicio + 2) ||
            ($f == $fInicio + 1 && $c == $cInicio - 2) || ($f == $fInicio - 1 && $c == $cInicio - 2)) {

        $valido = true;
    }
    return $valido;
}

function moverCPU($tablero, $fInicio, $cInicio, $fMovUsuario, $cMovUsuario) {
    $posiblesMov = [];
    if (isset($tablero[$fInicio + 2][$cInicio + 1])) {
        $posiblesMov[] = [$fInicio + 2, $cInicio + 1];
    }
    if (isset($tablero[$fInicio + 2][$cInicio - 1])) {
        $posiblesMov[] = [$fInicio + 2, $cInicio - 1];
    }
    if (isset($tablero[$fInicio - 2][$cInicio + 1])) {
        $posiblesMov[] = [$fInicio - 2, $cInicio + 1];
    }
    if (isset($tablero[$fInicio - 2][$cInicio - 1])) {
        $posiblesMov[] = [$fInicio - 2, $cInicio - 1];
    }
    if (isset($tablero[$fInicio + 1][$cInicio + 2])) {
        $posiblesMov[] = [$fInicio + 1, $cInicio + 2];
    }
    if (isset($tablero[$fInicio - 1][$cInicio + 2])) {
        $posiblesMov[] = [$fInicio - 1, $cInicio + 2];
    }
    if (isset($tablero[$fInicio + 1][$cInicio - 2])) {
        $posiblesMov[] = [$fInicio + 1, $cInicio - 2];
    }
    if (isset($tablero[$fInicio - 1][$cInicio - 2])) {
        $posiblesMov[] = [$fInicio - 1, $cInicio - 2];
    }
    if (in_array([$fMovUsuario, $cMovUsuario], $posiblesMov)) {
        return [$fMovUsuario, $cMovUsuario];
    } else {
        return $posiblesMov[rand(0, count($posiblesMov) - 1)];
    }
}
