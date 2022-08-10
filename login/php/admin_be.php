<?php
session_start();
if(isset($_POST['accion'])){
$accion=$_POST['accion'];
if($accion=="registrar"){
    $nombre=$_POST['admin'];
    $correo=$_POST['correo'];
    $pass=$_POST['pass'];
    
    require_once 'conexion.php';
    $database = new database(); 
    $con = $database->conectar();

    $res=$con->prepare("SELECT * FROM administrador WHERE nombre = '$nombre'");
    $res -> execute();
    $res = $res->rowCount();
    
    $rescorreo=$con->prepare("SELECT * FROM administrador WHERE correo = '$correo'");
    $rescorreo ->execute();
    $rescorreo = $rescorreo->rowCount();
    if($res>0){
        $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
         Ya existe un administrador con ese nombre
        </div>
      </div>';
      header("location:../../administrador/php/añadiradmin.php");
      exit;
    }
    if ($rescorreo>0) {
      $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
       Ya existe un administrador con ese correo
      </div>
    </div>';
    header("location:../../administrador/php/añadiradmin.php");
    exit;
    }
    else{

    $pass = hash('sha512',$pass);

    $res=$con->prepare("INSERT INTO administrador(nombre, correo,pass)
    VALUES ('$nombre','$correo','$pass')");
    $res->execute();
     $_SESSION['mensaje']='<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
     <div>
       Admin guardado con exito
     </div>
   </div>';
} header("location:../../administrador/php/añadiradmin.php");
}else if($accion=="iniciarsesion"){

    $correo=$_POST['correo'];
    $pass=$_POST['pass'];
    require_once 'conexion.php';
    $database = new database(); 
    $con = $database->conectar();

    $pass = hash('sha512',$pass);

    $verificar_correo = $con->prepare("SELECT * FROM administrador WHERE correo = '$correo'");
    $verificar_correo -> execute();
    $conteo_correo = $verificar_correo -> rowCount();

    $verificar_pass = $con->prepare("SELECT * FROM administrador WHERE pass = '$pass'");
    $verificar_pass -> execute();
    $conteo_pass = $verificar_pass -> rowCount();
    
    if ($conteo_correo>0) {
        if ($conteo_pass>0) {
            $_SESSION['correoadmin'] = $correo;
            $_SESSION['start'] = time();
            echo'
            <script>
            alert("Bienvenido administrador con correo: '.$correo.'");
            window.location = "../../indexadmin.php";
            </script>';
             exit;
    
         }else{

          $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Contraseña incorrecta
          </div>
        </div>';
          header("location:../../php/adminform.php");
            exit;
           }
        }else{
          $_SESSION['mensaje']='<div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Este correo no existe en nuestra base de datos
          </div>
        </div>';
          header("location:../../php/adminform.php");
          exit;
        } 
    }  

}


?>