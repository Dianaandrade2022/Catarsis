<!-- php -->
<?php
session_start();

  if (!isset($_SESSION['correocol'])) {
    echo session_id();
  echo 
  '<script>
  alert("Debes iniciar sesion");
  window.location ="../login/registro.php";
  </script>';
  session_destroy();
  die();
} 
require '../login/php/conexion.php';
$database = new database(); 
$con = $database->conectar();

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
$query = $con -> prepare ("SELECT * FROM persona inner join usuario on persona.id_usuario ='.$id.' limit 1");
$query ->execute();
$resultado = $query ->rowCount();
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
    <title>Completar datos</title>
    <link rel="stylesheet" href="../css/complemento.css">
</head> 
<body>
   

     
              <!-- menu -->
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
    
    <!--------------------------------------------------------------- apartado --------------------------------------------------------------->
<!--------------------------------------------------------------- apartado --------------------------------------------------------------->
       <!-- Cuerpo settings -->
       <div class="contenedor">
        <div class="block">
            <h2 class="text-center text-success">Tus datos ya han sido enviados exitosamente</h2>
</div>
        <div class="container">
    <form>
      <?php 
       foreach ($query as $row){

      ?>
        <h2>Completar datos</h2>
        <p>Teléfono<input type="tel" name ="telefonop" value="<?php echo $row['telefono']?>" disabled class = "inputd"></p>
        <p>Dirección<input type="text" name ="direccionp" value="<?php echo $row['direccion'] ?>" class = "inputd" disabled></p>
        <p>Nombre<input type="text" name ="nombrep" value="<?php echo $row['nombre'] ?>" class = "inputd" disabled></p>
        <p>Apellido Paterno<input type="text" name ="ApellidoPp" value="<?php echo $row['ApellidoM'] ?>" class = "inputd" disabled></p>
        <p>Apellido Materno<input type="text" name ="ApellidoMp" value="<?php echo $row['ApellidoP'] ?>" class = "inputd" disabled> </p>
        <p>Fecha de nacimiento<input type="text" name ="Fechap" class = "inputd" value="<?php echo $row['Fecha_Nacimiento'] ?>" disabled></p>
        <!-- select -->
        <p>Tipo de usuario
        <input name="Persona" value="<?php echo $row['tipo_persona'] ?>" class="inputd" disabled></p>
        <p>Foto de perfil 
            <input name="imagen1" value="<?php echo $row['foto_perfil'] ?>" class="inputd" disabled placeholder="sin foto de perfil"></p>
        </p>
        <p>País<input type="text" name ="paisp" value="<?php echo $row['pais'] ?>" class = "inputd" disabled></p>
        <p>Región<input type="text" name ="regionp" value="<?php echo $row['region'] ?>" class = "inputd" disabled></p>
        <p>Municipio<input type="text" name ="municipiop" value="<?php echo $row['municipio'] ?>" class = "inputd" disabled></p> 
        <div>
            <h2></h2>
        </div>
        <?php 
     }

      ?>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>