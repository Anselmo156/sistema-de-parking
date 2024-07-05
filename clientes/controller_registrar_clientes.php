<?php 

include('../app/config.php');

$placa_auto = $_GET['placa'];
$placa_auto = strtoupper($placa_auto);// CONVIERTE TODO A MAYÚCULAS
$nombre_cliente = $_GET['nombre_cliente'];
$nombre_cliente = strtoupper($nombre_cliente);// CONVIERTE TODO A MAYÚCULAS
$nit_ci_cliente = $_GET['nit_ci'];
$nit_ci_cliente = strtoupper($nit_ci_cliente);// CONVIERTE TODO A MAYÚCULAS

date_default_timezone_set("Europe/Madrid");
$fechaHora = date("Y-m-d H:i:s");

$sentencia = $pdo->prepare('INSERT INTO tb_clientes
(placa_auto, nombre_cliente, nit_ci_cliente, fyh_creacion, estado)
VALUES (:placa_auto, :nombre_cliente, :nit_ci_cliente, :fyh_creacion, :estado)');

$sentencia->bindParam(':placa_auto', $placa_auto);
$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':nit_ci_cliente', $nit_ci_cliente);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);

if($sentencia->execute()){
    echo 'success';
    //header('Location:' .$URL.'/');
}else{
     echo "Error al registrar a la base de datos";
}