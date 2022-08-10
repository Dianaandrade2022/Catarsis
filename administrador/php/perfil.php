<!-- php -->
<?php
session_start();

if (!isset($_SESSION['correoadmin'])) {
  echo
  '<script>
  alert("Debes iniciar sesion");
  window.location ="../login/registro.php";
  </script>';
  session_destroy();
  die();
}

require_once '../../login/php/conexion.php';
$database = new database(); 
$con = $database->conectar();

$usuario = $_SESSION['correoadmin'];
$consul = $con -> prepare("SELECT nombre FROM administrador WHERE correo = '$usuario'");
$consul -> execute();
$consul =  $consul->fetch(PDO::FETCH_ASSOC);
if (isset($consul)) {
    $user = $consul['nombre'];
}

  //verificar el id del usuario 
  $consulta = $con ->prepare("SELECT id_admin FROM administrador WHERE correo = '$usuario' ");
  $consulta ->execute();
  $consulta =  $consulta->fetch(PDO::FETCH_ASSOC);
  if (isset($consulta)) {
    $id = $consulta['id_admin'];
  }


$query = $con ->prepare("SELECT nombre, correo FROM administrador WHERE id_admin = '.$id.' ");
$query -> execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Iconos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>

    <link rel="short icon" href="../../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Mi perfil</title>
</head> 
<body>
<nav class="menu">
          <input type="checkbox" id="check">
          <label for="check" class="checkbtn">
            <i class="material-icons">menu</i>
          </label>
      <div>
        <a href="../../indexadmin.php" class="enlace"><img src="../../img/elementos/logohealthy.png" alt=""></a>
        </div>
        <ul class="Desplazable">
            <li><a href="../../indexadmin.php"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="verificarpsicologo.php"><i class="material-icons">check_box</i>Verificar psicologos</a></li>
            <li><a class="dropdown-item" href="../../login/php/cerrarsesion.php"><i class="material-icons">person</i>Cerrar Sesion</a></li>
            <li><a href="añadiradmin.php"><i class="material-icons">person_add</i>Añadir admin</a></li>
        </ul>
        <div class="usuario">
           <a href="perfil.php"><img src="../../img/elementos/user.png" alt=""></a>
            <a href="perfil.php" style="text-decoration: none; line-height: 80px;"><h3> <?php echo $user ?></h3></a>
        </div>
</nav>
    <!-- menu -->

    
    <!--------------------------------------------------------------- apartado --------------------------------------------------------------->
       <!-- Cuerpo settings -->
       <div class="contenedor">
        <div class="contenidoleft">
       <div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="z-index:2;">
    <button class="nav-link active" id="v-pills-informacion-tab" data-bs-toggle="pill" data-bs-target="#v-pills-informacion" type="button" role="tab" aria-controls="v-pills-informacion" aria-selected="true">Informacion</button>
    <a href="../../login/php/cerrarsesion.php" class="pt-4">Cerrar Sesion</a>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-tab" role="tabpanel" aria-labelledby="v-pills-informacion" tabindex="0">
       </div>
        <article>
           <div class="desc">
               <div class="titulo">
                   <h2 class="text-center">Información que puedes compartir con otras personas</h3>
               </div>
               <div class="parrafo">
                   <p>La información personal que has guardado en tu cuenta, como tu fecha de nacimiento o tu dirección de correo electrónico, y opciones para gestionarla.Esta información es privada, pero puedes hacer que otras personas puedan ver parte de ella en los servicios de HEALTHYMIND</p>
               </div>
                </div>
                <div class="containerall">
               <div class="cards">
<!------------------- Primer apartado ------------------->
                         <div class="card-1">
                           <div class="titulo">
                               <h3 class="pb-3">Informacion de contacto</h3>
                           </div>
                           <div class="parrafo">
                               <div class="containerinfo">
                                    <!-- <div class="leftxd">
                                        <h3>Perfil</h3>
                                        <p>Compartir estadisticas</p>
                                    </div> -->

                                   <div class="rightxd">
                                       <h5 class="pb-2">Tu información y quien puede verla</h5>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="perfil">
                        
                        <div class="row">
               <img src="../img/user.png" alt="">
               <p>Correo electrónico</p>
              <p><input class="form-control" type="text" value="<?php echo $user?>" disabled></p>
              <p>Nombre</p>
              <p><input class="form-control" type="text" disabled placeholder ="no ha enviado datos" value="<?php echo $consul['nombre'] ?>"></p>
              </div>  
            </div>
            
               </div>
           </div>
           
       </article>
    </div>
  </div>
</div>
</div>
    <!--------------------------------------------------------- Fin apartado -------------------------------------------------------------->
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>