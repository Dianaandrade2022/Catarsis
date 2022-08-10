<!-- php -->
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
$database = new database(); 
$con = $database->conectar();

$usuario = $_SESSION['correo'];
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

$query = $con -> prepare ("SELECT * FROM persona WHERE id_usuario = '$id'");
$query ->execute();
$resultado = $query ->fetchAll(PDO::FETCH_ASSOC);

$persona = $con -> prepare ("SELECT count(id_persona) FROM persona WHERE id_usuario = '$id'");
$persona ->execute();
if ($persona->fetchColumn()>0) {
}else{
    header("location:configuracionuser2.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>

    <link rel="short icon" href="../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
<link rel="stylesheet" href="../css/estilo.css">
<link rel="stylesheet" href="../css/configuracion.css">
    <title>Configuracion</title>
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
    <div class="d-flex align-items-start mt-5" id="contenedorc">
    <div class="nav flex-column nav-pills me-3 mt-5 p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link active" id="v-pills-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-info" type="button" role="tab" aria-controls="v-pills-info" aria-selected="true">Información personal</button>
      <button class="nav-link" id="v-pills-datos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-datos" type="button" role="tab" aria-controls="v-pills-datos" aria-selected="false">Complemento de datos</button>
      <button class="nav-link" id="v-pills-contactos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contactos" type="button" role="tab" aria-controls="v-pills-contactos" aria-selected="false" disabled>Contactos</button>
     </div>

     <div class="tab-content" id="v-pills-tabContent">
     <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab" tabindex="0">
         <article class="row p-4">
           <div class="desc">
               <div class="titulo">
                   <h2 class="text-center">Información personal</h3>
                   <?php
                        if(isset($_SESSION['actualizav'])){
                        echo $_SESSION['actualizav'];
                        unset ($_SESSION['actualizav']);

                     }
                     ?>
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
                               <h3 class="pb-3 ">Informacion de contacto</h3>
                           </div>
                           <div class="parrafo">
                               <div class="containerinfo">
                               </div>
                           </div>
                       </div>
                       <div class="perfil">

            <form action="../login/php/modipersona_be.php" method="POST">
                <?php foreach ($resultado as $row) {
                ?>
                        <div class="row">
               <img src="../img/user.png" alt="">
               <p class="">Correo electrónico</p>
              <p><input class="form-control" type="email" value="<?php echo $_SESSION['correo']?>" name="correo" required></p>
              <p class="">Foto de perfil</p>
              <?php if ($row['foto_perfil']=='') {
               $_SESSION['valor'] = '<div></div>';
              }else{
                $_SESSION['valor']='<div class="alert alert-info d-flex align-items-center p-2 w-50 m-4 mt-0 mb-1" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="0" height="10" role="img" aria-label="Info:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                foto:
                 '.$row['foto_perfil'].'
                </div>
              </div>';
              }
              ?>

              <p><input class="form-control" type="file" accept="image/*" value="<?php echo $row['foto_perfil']?>" name="foto"></p>
              <?php
                        if(isset($_SESSION['valor'])){
                        echo $_SESSION['valor'];
                        unset ($_SESSION['valor']);

                     }
                        ?>
              <p class="">Fecha de nacimiento</p>
              <p><input class="form-control col col-4" type="date" value="<?php echo $row['Fecha_Nacimiento'] ?>" name="fecha"></p>
              </div>  
              <button class="btn btn-dark col" value="modificar" name="accion">Modificar</button>
              <input type="reset" class="btn btn-dark">
              <?php 
                } ?>
            </form>
            </div>
               </div>
           </div>
       </article>
    </div>


     <div class="tab-pane fade" id="v-pills-datos" role="tabpanel" aria-labelledby="v-pills-datos-tab" tabindex="0">
     <div class="contenedor">
    <form action="../login/php/modipersona_be.php" method="POST">
    <?php if (isset($row['foto_perfil'])) {
                $_SESSION['valor']='<div class="alert alert-info d-flex align-items-center p-2 w-50 m-4 mt-0 mb-1" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="0" height="10" role="img" aria-label="Info:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                foto:
                 '.$row['foto_perfil'].'
                </div>
              </div>';
              }?>
    <h2 class="mt-2 text-center text-danger">Completar datos</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-3">
    <div class="form-group col col-6 mb-3">
        <label for="" class="form-label" class="col-3">Teléfono:</label>
        <input type="tel" name ="telefonop" placeholder="2381234567"  minlength="10" maxlenght="12" required class = "inputd" value="<?php echo $row['telefono']?>">
    </div>
    <div class="form-group col col-6 mb-3">
        <label for="" class="form-label">Dirección:</label>
        <input type="text" name ="direccionp" placeholder="Calle # Colonia" class = "inputd" value="<?php echo $row['direccion'] ?>">
    </div>
    <div class="form-group col-md-3 mb-3">
        <label for="" class="form-label">Nombre:</label>
        <input type="text" name ="nombrep" placeholder="Ingrese su nombre" required onKeyUp="minus(this);" class = "inputd" value="<?php echo $row['nombre'] ?>">
    </div>
    <div class="form-group col-md-4 mb-3">
        <label for="" class="form-label">Apellido Paterno:</label>
        <input type="text" name ="ApellidoPp" placeholder="Ingrese su apellido" onKeyUp="minus(this);" required class = "inputd" value="<?php echo $row['ApellidoP'] ?>">
    </div>
    <div class="form-group col-md-4 mb-3">
        <label for="" class="form-label">Apellido Materno:</label>
        <input type="text" name ="ApellidoMp" placeholder="Ingrese su apellido" required onKeyUp="minus(this);" class = "inputd" value="<?php echo $row['ApellidoM'] ?>">
    </div>
    <div class="form-group col-md-4 mb-3">
        <label for="" class="form-label">Fecha de nacimiento:</label>
        <input type="date" name ="Fechap" class = "inputd" value="<?php echo $row['Fecha_Nacimiento']?>" required>
    </div>
    <div class="form-group col-md-4 mb-3">
        <label for="" class="form-label">Tipo de usuario: <p class="text-muted"><?php echo $row['tipo_persona']?></p></label>
        <select name="Persona" required value="">
            <outgroup>
            <option value="Paciente">Paciente</option>
            <option value="Colaborador">Colaborador</option>
            </outgroup>
        </select>
    </div>
    <div class="form-group col-md-4 mb-3">
        <label for="" class="form-label">País:</label>
        <input type="text" name ="paisp" placeholder="Pais" class = "inputd" required value="<?php echo $row['pais'] ?>">
    </div>
    <div class="form-group col-md-4 mb-5">
        <label for="" class="form-label">Región:</label>
        <input type="text" name ="regionp" placeholder="Región" class = "inputd" required value="<?php echo $row['municipio'] ?>">
    </div>
    <div class="form-group col-md-7 mb-5">
        <label for="" class="form-label">Municipio:</label>
        <input type="text" name ="municipiop" placeholder="Municipio" class = "inputd" required value="<?php echo $row['region'] ?>">
    </div>
    </div>
    <div class="col col-12 mb-3">
        <button class="btn btn-dark" value="modificartotal" name="accion">Modificar</button>
        <input type="reset" class="btn btn-dark">
        </div>
    </form>
    </div>
</div>
    <script type="text/javascript">
function onLoadImage(files){
  console.log(files)
  if (files && files[0]) {
    document
      .getElementById('seleccionimg')
      .innerHTML = files[0].name
  }
}
    </script>
     </div>

     <div class="tab-pane fade" id="v-pills-contactos" role="tabpanel" aria-labelledby="v-pills-contactos-tab" tabindex="0">contactos</div>

   </div>
 </div> 
 <script>
        function minus(e){
            e.value = e.value.toLowerCase();
        }
    </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>