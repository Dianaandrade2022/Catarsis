<?php
session_start();
require_once 'conexion.php';
$database = new database();
$con = $database->conectar();

$usuario = $_SESSION['correo'];
$resultid = $con -> prepare("SELECT id_usuario from usuario where correo = '$usuario'");
$resultid -> execute();
$id =  $resultid->fetch(PDO::FETCH_ASSOC);
if (isset($id['id_usuario'])) {
    $varid = $id['id_usuario'];
}

$conteovar = $con -> prepare("SELECT * FROM persona inner join usuario on 'usuario.id_usuario'= 'persona.id_usuario' ");
$conteovar ->execute();
$conteovar = $conteovar ->rowCount();
if ($conteovar>0) {
   $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
   <div>
   usted ya ha ingresado datos
   </div>
 </div>';
 header("location:../../php/complementar.php");
 exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$telefonop = $_POST ['telefonop'];
$direccionp = $_POST ['direccionp'];
$nombrep = $_POST ['nombrep'];
$ApellidoPp = $_POST ['ApellidoPp'];
$ApellidoMp = $_POST ['ApellidoMp'];
$Fechap = $_POST ['Fechap'];
$Persona = $_POST ['Persona'];
$imagen1 = $_POST ['imagen1'];
$paisp = $_POST ['paisp'];
$regionp = $_POST ['regionp'];
$municipiop = $_POST ['municipiop'];

$insertarp = $con -> prepare("INSERT INTO `persona`( `telefono`, `direccion`, `nombre`, `ApellidoM`, `ApellidoP`, 
`Fecha_Nacimiento`, `tipo_persona`, `foto_perfil`, `pais`, `region`, `municipio`,`id_usuario`)
VALUES('$telefonop','$direccionp','$nombrep','$ApellidoPp','$ApellidoMp','$Fechap','$Persona','$imagen1','$paisp',
'$regionp','$municipiop','$varid')");
        try {

            $conteo_tel= $con->prepare("SELECT telefono FROM persona where telefono = $telefonop");
            $conteo_tel ->execute();
            $conteo_tel = $conteo_tel ->rowCount();
            if ($conteo_tel>0) {
                    $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                el telefono ya existe en nuestra base de datos
                </div>
                </div>';
                header("location:../../php/complementar.php");
                exit;
                    if ($conteo_tel) {
                }else {
                throw new RuntimeException('Tipo de dato incorrecto');
             }
                } 
            }
        catch (RuntimeException $e) {
            header("location:../../php/complementar.php");
            $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Solo escriba números en su número telefonico
            </div>
            </div>';
            exit;
            }

                $insertarp -> execute(); 
                if ($insertarp) {
                    header("location:../../php/complementarshow.php");
                    exit;
                }else{
                    $_SESSION['errorimagen']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Sus datos no se han guardado verifique de nuevo 
                    </div>
                  </div>';
                  header("location:../../php/complementar.php");
                  exit;
                    }
}


            




?>