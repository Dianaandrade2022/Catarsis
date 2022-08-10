<?php
session_start();
require_once '../../../login/php/conexion.php';
$database = new database(); 
$con = $database->conectar();

//verificar el id del usuario

if (isset($_POST['accion'])) {
    $accion=$_POST['accion'];
    if ($accion=="modificar") {
        $id_colaborador = $_POST['id_col'];
        $query = $con -> prepare("UPDATE colaborador SET `admin` = 1 WHERE `id_colaborador` = '$id_colaborador'");
        $query ->execute();
        if ($query) {
            $_SESSION['actualizav'] =
            '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
   <div>
   Colaborador añadido correctamente
   </div>
 </div>';
 header("location:../aceptados.php");
 exit;
        }

    }

    if($accion=='rechazar'){
        $id_colaborador = $_POST['id_col'];
        $rechazar = $con -> prepare("UPDATE colaborador SET `admin` = 2 WHERE `id_colaborador` = '$id_colaborador'");
        $rechazar ->execute();
        if($rechazar){
            $_SESSION['actualizav'] =
            '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Se ah rechazado correctamente 
            </div>
          </div>';
            header("location:../rechazados.php");
            exit;

        }
    }
    
}
?>