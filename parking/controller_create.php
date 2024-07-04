<?php 

include('../app/config.php');

$nro_espacio = $_GET['nro_espacio'];
$estado_espacio = $_GET['estado_espacio'];
$obs = $_GET['obs'];

// echo $nro_espacio."-".$estado_espacio."-".$obs;

date_default_timezone_set("Europe/Madrid");
$fechaHora = date("Y-m-d H:i:s");

$sentencia = $pdo->prepare("INSERT INTO tb_mapeos 
        (nro_espacio, estado_espacio, obs, fyh_creacion, estado) 
VALUES (:nro_espacio, :estado_espacio, :obs, :fyh_creacion, :estado)");

$sentencia->bindParam('nro_espacio', $nro_espacio);
$sentencia->bindParam('estado_espacio', $estado_espacio);
$sentencia->bindParam('obs', $obs);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);

if($sentencia->execute()){
    echo "Registro satisfactorio";
    //header('index.php');
    ?>
    <script>location.href = "mapeo-de-vehiculos.php";</script>
    <?php
}else{
    echo "No se pudo registrar a la base de datos";
}