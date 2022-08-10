<?php
session_start();
if (isset($_SESSION['correo'])) {

include 'conexion.php';
$database = new database();
$con = $database->conectar();

//seleccionamos el id del usuario
$usuario = $_SESSION['correo'];
$consul = $con -> prepare("SELECT id_usuario FROM usuario WHERE correo = '$usuario'");
$consul -> execute();
$consul =  $consul->fetch(PDO::FETCH_ASSOC);
if (isset($consul)) {
    $id = $consul['id_usuario'];
}

//con ello seleccionamos el id de la persona que esta logueada y completo el formulario previo
$resultid = $con -> prepare("SELECT id_persona,id_usuario FROM persona WHERE id_usuario = '$id'");
$resultid -> execute();
$resultid =  $resultid->fetch(PDO::FETCH_ASSOC);

if (isset($resultid['id_persona'])) {
    $varid = $resultid['id_persona'];
} else{
    $_SESSION['mensaje'] =
    '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
    Primero rellene datos de complemento
    </div>
  </div>';
    header("location:../../php/complementar.php");
    exit;
}

//verificar que solo lo envie una vez
$conteovar = $con -> prepare("SELECT * FROM colaborador WHERE id_persona = '$varid'");
$conteovar ->execute();
$conteovar = $conteovar ->rowCount();
if ($conteovar>0) {
    $_SESSION['envia'] =
    '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
    Usted ya ha ingresado datos
    </div>
  </div>';
  header("location:../../php/colaboradorshow.php");
   exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$cedula = $_POST['cedula'];
$curp = $_POST['curp'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$años = $_POST['años'];
$tipoconsulta = $_POST['tipoconsulta'];
$educacion = $_POST['educacion'];
$especialidad = $_POST['especialidad'];
$ubicacion = $_POST['ubicacion'];
$certificado = $_POST['certificado'];


//verificar curp
$verificar_curp = $con -> prepare("SELECT * FROM colaborador WHERE Curp = '$curp'");
$verificar_curp -> execute();
$conteo = $verificar_curp -> rowcount();
if ($conteo > 0) {
    $_SESSION['envia'] =
    '<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
    Esta curp esta en nuestra base de datos porfavor verifiquela
    </div>
  </div>';
  header("location:../../php/colaborador.php");
    exit;
} else {
    $solicitud= $con -> prepare ("INSERT INTO `colaborador`(`cedula`, `Curp`, `descripcion`, `precio`, `experiencia`, `metodo`, `educacion`, `especialidad`, `ubicacion`,`certificado`, `id_persona`) 
    VALUES ('$cedula','$curp','$descripcion','$precio','$años','$tipoconsulta','$educacion','$especialidad','$ubicacion','$certificado','$varid')");
$solicitud -> execute();

if ($solicitud) {
    $_SESSION['envia'] =
    '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
    Datos ingresado correctamente ✔️✔️
    </div>
  </div>';
  header("location:../../php/colaboradorshow.php");  
    exit;
}
}
}
}
?>