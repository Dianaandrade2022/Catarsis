<?php
session_start();
require_once '../../login/php/conexion.php';
$database = new database(); 
$con = $database->conectar();

$usuario = $_SESSION['correocol'];
//verificar el id del usuario
$consulta = $con ->prepare("SELECT id_usuario FROM usuario WHERE correo = '$usuario' ");
$consulta ->execute();
$consulta =  $consulta->fetch(PDO::FETCH_ASSOC);
if (isset($consulta)) {
  $id = $consulta['id_usuario'];
}
$id_persona = $con -> prepare("SELECT id_persona FROM persona INNER JOIN usuario ON persona.id_usuario = usuario.id_usuario WHERE usuario.id_usuario = '$id'");
$id_persona ->execute();
$id_persona = $id_persona->fetch(PDO::FETCH_ASSOC);
if (isset($id_persona)) {
    $id_persona = $id_persona['id_persona'];
  }
if (isset($_POST['accion'])) {

    $accion=$_POST['accion'];
    if ($accion=="cancelarplan") {

        $query = $con -> prepare("DELETE FROM colaborador where id_persona = '$id_persona'");
        $query ->execute();
        if ($query) {
            $usuario = $_SESSION['correo'];
        }
        if ($query) {
            session_destroy();
            header("location:../../index2.php");
        }
    }
}
?>