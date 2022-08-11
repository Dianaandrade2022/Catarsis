<?php

session_start();

if (!isset($_SESSION['correo'])) {
  echo 
  '<script>
  alert("Debes iniciar sesion");
  window.location ="../login/registro.php";
  </script>';
  session_destroy();
  die();
}
require_once '../login/php/conexion.php';
require '../config/prueba.php';
$database = new database(); 
$con = $database->conectar();

$usuario = $_SESSION['correo'];
$consul = $con -> prepare("SELECT usuario FROM usuario WHERE correo = '$usuario'");
$consul -> execute();
$consul =  $consul->fetch(PDO::FETCH_ASSOC);
if (isset($consul)) {
    $user = $consul['usuario'];
}


$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '' ) {
    echo'<div class="alert alert-danger d-flex align-items-center mt-1" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
     Página no encontrada
    </div>
  </div>';
    exit;
}else{
    $token_tmp = hash_hmac('sha512',$id,KEY_TOKEN);

    if($token == $token_tmp){
       $sql = $con ->prepare("SELECT count(id_colaborador) FROM colaborador where id_colaborador=$id");
       $sql->execute();
       if ($sql->fetchColumn()>0) {
        $sql = $sql ->fetchAll(PDO::FETCH_ASSOC);
       }
       $query = $con->prepare("SELECT * FROM colaborador inner join persona on persona.id_persona = colaborador.id_persona where id_colaborador = '$id'");
       $query ->execute();
       $query = $query ->fetchAll(PDO::FETCH_ASSOC);

    }else{
        echo '<div class="alert alert-danger d-flex align-items-center mt-1" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        Error al procesar petición
        </div>
      </div>';
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- iconos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="short icon" href="../img/iconos/icon.png"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/psicologos.css">
    <title>Psicologos</title>
</head>
<body>
<nav class="menu">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="material-icons">menu</i>
        </label>
        <div>
        <a href="../index2.php" class="enlace"><img src="../img/elementos/logohealthy.png" alt=""></a>
        </div>
        <ul>
            <li><a href="../index2.php"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="sobre.php"><i class="material-icons">people</i>Sobre Nosotros</a></li>
            <li><a href="configuracionuser.php"><i class="material-icons">dvr</i>Contacto</a></li>
     <li><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
       Mi perfil
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="complementar.php"><i class="material-icons">add</i>Complementar datos</a></li>
        <li><a class="dropdown-item" href="test.php"><i class="material-icons">streetview</i>Contestar test</a></li>
        <li><a class="dropdown-item" href="perfil.php"><i class="material-icons">remove_red_eye</i>Ver perfil</a></li>
        <li><a class="dropdown-item" href="configuracionuser.php"><i class="material-icons">settings</i>Configuracion</a></li>  
      </ul></li>
      <li>
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Mas 
               </button>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                 <li><a class="dropdown-item" href="plan.php"><i class="material-icons">assessment</i>Ver planes</a></li>
                 <li><a class="dropdown-item" href="../login/php/cerrarsesion.php"><i class="material-icons">person</i>Cerrar Sesion</a></li>
                 <li><a class="dropdown-item" href="psicologos.php"><i class="material-icons">person_pin_circle</i>Ver psicologos</a></li>
                 <li><a class="dropdown-item" href="mostrar.php"><i class="fa-solid fa-comment-check"></i>Ver test</a></li>
               </ul></li>
      </ul>
   <div class="usuario">
            <a href="perfil.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="perfil.php" style="text-decoration: none;"><h3 class="h1 text-capitalize"><?php echo $user?></h3></a>
        </div>
    </nav>
    <!-- menu -->
        <!-- CONTENIDO -->
        <div class="info">
                <h3 class="text-center display-5 text-light bg-dark pt-3 pb-3" style="width:100vw;">Psicologo</h3>
            </div>
        
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 p-2">
    <?php foreach ($query as $row) {
    ?>
            <div class="col">
                <div class="card m-2 mt-3 p-2 bg-transparent border border-light">
                <?php
                   $id = $row['id_colaborador'];
                   $img = "img/$id/main.jpg";
                   if (!file_exists($img)) {
                    $img = "img/user.png";
                   }
                   ?>

                    <img src="<?php echo $img?>" alt="" class="card-img-top" style="width:15vw; margin:auto;">
                        <div class="card-body">
                        <h5 class="card-title text-dark text-capitalize"><i class="material-icons"></i>Nombre: <p clas="text-capitalize"><?php echo $row['nombre'];echo ' '; echo $row['ApellidoP'];echo ' ';  echo $row['ApellidoM']?></p></h5>
                        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Cédula: </p> <?php echo $row['cedula']?></p>
                        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Certificado: </p> <?php echo $row['certificado']?></p>
                        <div class="d-flex justify-content-start align-items-center pt-3">
                                <input type="number" hidden class="disabled"  value="<?php echo $id?>" name="id_col">
                                <button class="btn btn-dark m-1 mt-0" value="" name="accion" type="submit">Contactar</button>
                    </div>
                    </div>
                </div>
            </div>
            
         <?php 
        
    }?>
    <div class="col">
    <div class="card m-1 mt-3 bg-transparent border-0">
        <div class="card-body">
        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Sesiones en: </p> <?php echo $row['metodo']?></p>
        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Precio estandar: </p> <?php echo $row['precio']?></p>
                        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Laborando desde: </p> <?php echo $row['experiencia']?></p>
                        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Especialidad: </p> <?php echo $row['especialidad']?></p>
                        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Ubicación: </p> <?php echo $row['ubicacion']?></p>
                        <p class="card-text col-8 text-lowercase"> <p class="fw-bold">Descripción: </p> <?php echo $row['descripcion']?></p>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>


