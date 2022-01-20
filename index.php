<?php

require "vendor/autoload.php";

include "functions.php";

use eftec\bladeone\BladeOne;

$Views = __DIR__ . '\Views';
$Cache = __DIR__ . '\Cache';

$Blade = new BladeOne($Views, $Cache);

define("BOARD_SIZE", 8);

session_start();

if (empty($_POST)) {

    $tablero = array_fill(0, BOARD_SIZE, array_fill(0, BOARD_SIZE, ""));
    $coordInicUsuario = posicionInicialUsuario($tablero);
    $_SESSION['fInicUsuario'] = $coordInicUsuario[0];
    $_SESSION['cInicUsuario'] = $coordInicUsuario[1];
    $coordInicCPU = posicionInicialCPU($tablero);
    $_SESSION['fInicCPU'] = $coordInicCPU[0];
    $_SESSION['cInicCPU'] = $coordInicCPU[1];
    $_SESSION['tablero'] = $tablero;

    echo $Blade->run('board', ['fInicUsuario' => $_SESSION['fInicUsuario'], 'cInicUsuario' => $_SESSION['cInicUsuario'], 'fInicCPU' => $_SESSION['fInicCPU'], 'cInicCPU' => $_SESSION['cInicCPU']]);

} else {

    $tablero = $_SESSION['tablero'];
    $fInicUsuario = $_SESSION['fInicUsuario'];
    $cInicUsuario = $_SESSION['cInicUsuario'];
    $fInicCPU = $_SESSION['fInicCPU'];
    $cInicCPU = $_SESSION['cInicCPU'];

    $fMovUsuario = filter_input(INPUT_POST, 'f');
    $cMovUsuario = filter_input(INPUT_POST, 'c');

    $movValido = comprobarJugadaUsuario($fMovUsuario, $cMovUsuario, $fInicUsuario, $cInicUsuario);

    if ($movValido) {
        $tablero[$fInicUsuario][$cInicUsuario] = "";
        $tablero[$fMovUsuario][$cMovUsuario] = "*";
        $result["fMovUsuario"] = $fMovUsuario;
        $result["cMovUsuario"] = $cMovUsuario;
        $result["fIniUsuario"] = $fInicUsuario;
        $result["cIniUsuario"] = $cInicUsuario;

        if ($fMovUsuario == $fInicCPU && $cMovUsuario == $cInicCPU) {
            $result["final"] = 1;
        } else {
            $coordMovCPU = moverCPU($tablero, $fInicCPU, $cInicCPU, $fMovUsuario, $cMovUsuario);
            $fMovCPU = $coordMovCPU[0];
            $cMovCPU = $coordMovCPU[1];
            $tablero[$fInicCPU][$cInicCPU] = "";
            $tablero[$fMovCPU][$cMovCPU] = "+";
            $result["fMovCPU"] = $fMovCPU;
            $result["cMovCPU"] = $cMovCPU;
            $result["fIniCPU"] = $fInicCPU;
            $result["cIniCPU"] = $cInicCPU;
            if ($fMovCPU == $fMovUsuario && $cMovCPU == $cMovUsuario) {
                $result["final"] = -1;
            } else {
                $_SESSION['fInicUsuario'] = $fMovUsuario;
                $_SESSION['cInicUsuario'] = $cMovUsuario;
                $_SESSION['fInicCPU'] = $fMovCPU;
                $_SESSION['cInicCPU'] = $cMovCPU;
                $_SESSION['tablero'] = $tablero;
            }
        }
    } else {
        $result["invalido"] = "¡NO PUEDES MOVERTE AHI!";
    }
    
    header('Content-type: application/json');
    echo json_encode($result);
    
}