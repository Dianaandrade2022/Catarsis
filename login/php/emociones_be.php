<?php 
session_start();
require 'conexion.php';
$database = new database();
$con = $database->conectar();

$usuario = $_SESSION['correo'];
$resultid = $con -> prepare("SELECT id_usuario from usuario where correo = '$usuario'");
$resultid -> execute();
$id =  $resultid->fetch(PDO::FETCH_ASSOC);
if (isset($id['id_usuario'])) {
    $varid = $id['id_usuario'];
} 
echo '<div>id:</div>';
var_dump($varid);

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $datelocal = date('Y-m-d h:i:s a', time());  
    $emociones = $_POST['emociones'];

   if ($emociones == '') {
    $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
     Escoga un dato porfavor
    </div>
  </div>';
  header("location:../../php/test.php");
  exit;
   }else{
    $insertars = $con -> prepare("INSERT INTO `emociones`(`emocion`,`fecha`, `id_usuario`) 
    VALUES ('$emociones','$datelocal','$varid')");
    $insertars ->execute();
    $_SESSION['mensaje']='<div class="alert alert-info d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
     Test de emociones enviado correctamente
    </div>
  </div>';
  header("location:../../php/test.php");
}
}
?>