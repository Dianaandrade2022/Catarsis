<?php

session_start();

if (!isset($_SESSION['correocol'])) {
  echo 
  '<script>
  alert("Debes iniciar sesion");
  window.location ="../login/registro.php";
  </script>';
  session_destroy();
  die();
}
require '../config/prueba.php';
require_once 'login/php/conexion.php';
$database = new database(); 
$con = $database->conectar();;

$id = isset($_GET['id_colaborador']) ? $_GET['id_colaborador'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '' ) {
    echo '<div>id y token vacios </div>';
    exit;
}else{
    $token_tmp = hash_hmac('sha512',$id,KEY_TOKEN);

    if($token == $token_tmp){
       
    }else{
        echo '<div>Error al procesar la petición :c</div>';
        exit;
    }
}

$usuario = $_SESSION['correocol'];
$consul = $con -> prepare("SELECT usuario FROM usuario WHERE correo = '$usuario'");
$consul -> execute();
$consul =  $consul->fetch(PDO::FETCH_ASSOC);
if (isset($consul)) {
    $user = $consul['usuario'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- iconos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="short icon" href="../img/iconos/icon.png"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- estilos -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="../css/psicologos.css">
    <title>Psicologos</title>
</head>
<body>

      
              <!-- menu -->
              <nav class="menu">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="material-icons">menu</i>
        </label>
        <div>
        <a href="../indexcolaborador.php" class="enlace"><img src="../img/elementos/logohealthy.png" alt=""></a>
        </div>
        <ul>
            <li><a href="../indexcolaborador.php"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="sobre.php" ><i class="material-icons">people</i>Sobre Nosotros</a></li>
     <li><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
       Mi perfil
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="perfil.php"><i class="material-icons">remove_red_eye</i>Ver perfil</a></li>
        <li><a class="dropdown-item" href="pacientes.php"><i class="material-icons">remove_red_eye</i>Ver pacientes</a></li>
        <li><a class="dropdown-item" href="configuracion.php"><i class="material-icons">settings</i>Configuracion</a></li>  
      </ul></li>
      <li>
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Mas 
               </button>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
               <li><a class="dropdown-item" href="plan.php"><i class="material-icons">assessment</i>Cambiar plan</a></li>
                 <li><a class="dropdown-item" href="../login/php/cerrarsesion.php"><i class="material-icons">person</i>Cerrar Sesion</a></li>
               </ul></li>
      </ul>
   <div class="usuario">
            <a href="perfil.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="perfil.php" style="text-decoration: none;"><h3><?php echo $user?></h3></a>
        </div>
    </nav>
<!-- menu -->
        <!-- CONTENIDO -->
        <div class="info">
                <h3 class="text-start text-light bg-dark pt-3 pb-3" style="width:100vw;">Psicologos</h3>
            </div>
        <div class="container">
           <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">


    
           </div> 
            
        </div>
        
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>