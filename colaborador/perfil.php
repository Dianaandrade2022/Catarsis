<!-- php -->
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
require '../login/php/conexion.php';
require '../config/prueba.php';
$database = new database(); 
$con = $database->conectar();

$sql = $con ->prepare("SELECT * FROM persona,usuario");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

$usuario = $_SESSION['correocol'];
$consul = $con -> prepare("SELECT usuario FROM usuario WHERE correo = '$usuario'");
$consul -> execute();
$consul =  $consul->fetch(PDO::FETCH_ASSOC);
if (isset($consul)) {
    $user = $consul['usuario'];
}

  //verificar el id del usuario 
  $consulta = $con ->prepare("SELECT id_usuario FROM usuario WHERE correo = '$usuario' ");
  $consulta ->execute();
  $consulta =  $consulta->fetch(PDO::FETCH_ASSOC);
  if (isset($consulta)) {
    $id = $consulta['id_usuario'];
  }

  $persona = $con -> prepare ("SELECT count(id_persona) FROM persona WHERE id_usuario = '$id'");
  $persona ->execute();
  if ($persona->fetchColumn()>0) {
     } else{
      header("location:perfil2.php");
     }
$query = $con ->prepare("SELECT Fecha_Nacimiento, foto_perfil FROM persona WHERE id_usuario = '.$id.' ");
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
    <link rel="short icon" href="../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Mi perfil</title>
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
            <li><a href="#" ><i class="material-icons">dvr</i>Contacto</a></li>
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

    
    <!--------------------------------------------------------------- apartado --------------------------------------------------------------->
       <!-- Cuerpo settings -->
    
    <!--------------------------------------------------------------- apartado --------------------------------------------------------------->
       <!-- Cuerpo settings -->
       <div class="contenedor">
        <div class="contenidoleft">
       <div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="z-index:2;">
    <button class="nav-link active" id="v-pills-informacion-tab" data-bs-toggle="pill" data-bs-target="#v-pills-informacion" type="button" role="tab" aria-controls="v-pills-informacion" aria-selected="true">Informacion</button>
    <a href="complementarshow.php" class="pt-4">Ver datos complemento</a>
    <a href="../login/php/cerrarsesion.php" class="pt-4">Cerrar Sesion</a>
    <!-- modal -->
    <button type="button" class="btn border-0 text-primary p-0 pt-4 m-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
     Dejar de ser colaborador
    </button>
  </div>

    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Confirmación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Esta seguro que quiere dejar de ser colaborador?
            Una vez realizada esta acción eliminara sus datos de colaborador y su verificación como profesional de HEALTHYMIND
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn border border-dark" value="eliminarcolab">Continuar</button>
          </div>
        </div>
      </div>
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
                        <?php foreach ($query as $row) {
                        ?>
                        <div class="row">
               <img src="../img/user.png" alt="">
               <p>Correo electrónico</p>
              <p><input class="form-control" type="text" value="<?php echo $_SESSION['correocol']?>" disabled></p>
              <p>Foto de perfil</p>
              <p><input class="form-control" type="text" disabled placeholder ="no ha enviado datos" value="<?php echo $row['foto_perfil'] ?>"></p>
              <p>Fecha de nacimiento</p>
              <p><input class="form-control col col-4" type="text" disabled value="<?php echo $row['Fecha_Nacimiento'] ?>"></p>
              </div>  
            </div>
            <?php
          }
          ?>
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