<!-- php -->
<?php
session_start();

  if (!isset($_SESSION['correo'])) {
    echo session_id();
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

$query = $con -> prepare ("SELECT * FROM persona inner join usuario on persona.id_usuario ='.$id.'");
$query ->execute();
$resultado = $query ->rowCount();
if ($resultado>0) {
  header("location:complementarshow.php");
}

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

    <link rel="short icon" href="../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Completar datos</title>
    <link rel="stylesheet" href="../css/complemento.css">
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
            <a href="../php/perfil.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="../php/perfil.php" style="text-decoration: none;"><h3 class="h1 text-capitalize"><?php echo $user?></h3></a>
        </div>
    </nav>
    <!-- menu -->
    <!--------------------------------------------------------------- apartado --------------------------------------------------------------->
       <!-- Cuerpo settings -->
<div class="contenedor">
        <div class="block">
            <h2>Para seguir con tu registro, solo llenarás a continuación una complementación de tus datos para brindate una mejor atención</h2>
            <?php
                        if(isset($_SESSION['mensaje'])){
                        echo $_SESSION['mensaje'];
                        unset ($_SESSION['mensaje']);

                     }
                        ?>
</div>
        <div class="contenedor">
    <form action="../login/php/complemento_be.php" method="POST">
        <h2>Completar datos</h2>
        <p>Teléfono<input type="tel" name ="telefonop" placeholder="2381234567" required class = "inputd"  minlength="10" maxlenght="12"></p>
        <p>Dirección<input type="text" name ="direccionp" placeholder="Calle # Colonia" class = "inputd"></p>
        <p>Nombre<input type="text" name ="nombrep" placeholder="Ingrese su nombre" required class = "inputd" onKeyUp="minus(this);" ></p>
        <p>Apellido Paterno<input type="text" name ="ApellidoPp" placeholder="Ingrese su apellido" required class = "inputd" onKeyUp="minus(this);" ></p>
        <p>Apellido Materno<input type="text" name ="ApellidoMp" placeholder="Ingrese su apellido" required class = "inputd" onKeyUp="minus(this);" > </p>
        <p>Fecha de nacimiento<input type="date" name ="Fechap" class = "inputd" required></p>
        <!-- select -->
        <p>Tipo de usuario
        <select name="Persona" required>
            <outgroup>
            <option value="Paciente">Paciente</option>
            <option value="Colaborador">Colaborador</option>
            </outgroup>
        </select></p>
        <p>Foto de perfil 
            <label for="imagen1" class="label">Seleccionar</label>
            <input type="file" name="imagen1" accept="image/*" class="inputf" id = "imagen1"  onChange="onLoadImage(event.target.files)">
            <span id="seleccionimg" style="font-weight: normal;"></span>
        </p>
        <?php
                        if(isset($_SESSION['errorimagen'])){
                        echo $_SESSION['errorimagen'];
                        unset ($_SESSION['errorimagen']);

                     }
                        ?>
        <p>País<input type="text" name ="paisp" placeholder="Pais" class = "inputd" required></p>
        <p>Región<input type="text" name ="regionp" placeholder="Región" class = "inputd" required></p>
        <p>Municipio<input type="text" name ="municipiop" placeholder="Municipio" class = "inputd" required></p> 

        <button class="botonst">Guardar</button>
    </form>
    </div>
</div>
    <script src="php/complemento_be.php"></script>
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
    <script>
        function minus(e){
            e.value = e.value.toLowerCase();
        }
    </script>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>