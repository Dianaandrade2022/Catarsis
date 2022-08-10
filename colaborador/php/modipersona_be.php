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

if (isset($_POST['accion'])) {

    $accion=$_POST['accion'];
    if ($accion=="modificar") {
        $correo = $_POST['correo'];
        $foto = $_POST['foto'];
        $fecha = $_POST['fecha'];

        $query = $con -> prepare("UPDATE usuario SET `correo` = '$correo' WHERE `id_usuario` = '$id'");
        $query ->execute();
        $query = $con ->prepare("UPDATE persona SET `foto_perfil` = '$foto', `Fecha_Nacimiento`= '$fecha' WHERE id_usuario = '$id' ");
        $query ->execute();
        $correon = $con ->prepare("SELECT correo FROM usuario WHERE id_usuario = '$id'");
        $correon ->execute();
        $correon = $correon ->fetch(PDO::FETCH_ASSOC);
        $correon = $correon['correo'];
        if ($query) {
            $_SESSION['actualizav'] =
            '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
   <div>
   Datos actualizados correctamente ✔️
   </div>
 </div>';
            header("location:../configuracion.php");
            $_SESSION['correocol'] = $correon;
        }
    }
    if($accion=='modificartotal'){
        $telefonop = $_POST ['telefonop'];
        $direccionp = $_POST ['direccionp'];
        $nombrep = $_POST ['nombrep'];
        $ApellidoPp = $_POST ['ApellidoPp'];
        $ApellidoMp = $_POST ['ApellidoMp'];
        $Fechap = $_POST ['Fechap'];
        $Persona = $_POST ['Persona'];
        $paisp = $_POST ['paisp'];
        $regionp = $_POST ['regionp'];
        $municipiop = $_POST ['municipiop'];

        $total = $con -> prepare("UPDATE `persona` SET `telefono`='$telefonop',`direccion`='$direccionp',`nombre`='$nombrep',
        `ApellidoM`='$ApellidoPp',`ApellidoP`='$ApellidoMp',`Fecha_Nacimiento`='$Fechap',`tipo_persona`='$Persona',
        `pais`='$paisp',`region`='$regionp',`municipio`='$municipiop' WHERE `id_usuario` = '$id'");
        $total ->execute();
        if($total){
            $_SESSION['actualizav'] =
            '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Datos de complemento actualizados correctamente ✔️ 
            </div>
          </div>';
            header("location:../../php/configuracionuser.php");
        }
    }
    
if (isset($_POST['accion'])) {

    $accion=$_POST['accion'];
    if ($accion=="modificarusuario") {
        $correo = $_POST['correo'];

        $query = $con -> prepare("UPDATE usuario SET `correo` = '$correo' WHERE `id_usuario` = '$id'");
        $query ->execute();
        $correon = $con ->prepare("SELECT correo FROM usuario WHERE id_usuario = '$id'");
        $correon ->execute();
        $correon = $correon ->fetch(PDO::FETCH_ASSOC);
        $correon = $correon['correo'];
        if ($query) {
            $_SESSION['actualizav'] =
            '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
   <div>
   Datos actualizados correctamente ✔️
   </div>
 </div>';
            header("location:../../php/configuracionuser2.php");
            $_SESSION['correo'] = $correon;
        }
    }
}
}
?>