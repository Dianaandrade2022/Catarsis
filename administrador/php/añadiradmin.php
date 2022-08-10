<!-- php -->
<?php
session_start();

if (!isset($_SESSION['correoadmin'])) {
  echo 
  '<script>
  alert("No tienes autorización");
  window.location ="../../php/adminform.php";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- iconos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="short icon" href="../../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">  
    <!-- estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/registro.css">
    <title>Añadir administrador</title>
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


<div class="containerbody">
            <div class="pt-3">
                <h2 class="text-center text-danger">Puedes agregar cuentas de otros administradores</h2>
            </div>
    <!-- Empieza contenido -->
        <div class="contenedor_todo">
            <div class="cajatrasera">
                <div class="caja_traseralogin" style="visibility: hidden;">
                    <h3>¿Ya te has registrado?</h3>
                    <p>¿Qué esperas?. Inicia Sesión Ahora</p>
                    <button id="btn_Login" class="btn btn-dark">Iniciar Sesión</button>
                </div>
                <div class="caja_delanteraregistro">
                    <h3>Puedes agregar más administradores</h3>
                    <?php
                        if(isset($_SESSION['mensaje'])){
                        echo $_SESSION['mensaje'];
                        //evita que aparezca siempre
                        unset ($_SESSION['mensaje']);

                     }
                        ?>
                    
                </div>
            </div>

            <div class="loginregistro">

            <form action="../../login/php/admin_be.php" method="POST" class="form_registrar">
                        <h2>Registrar</h2>
                        <input type="text" placeholder="Usuario de administrador" name="admin" required>
                        <input type="email" placeholder="Correo electronico" name="correo" required>
                        <input type="password" placeholder="Contraseña" name="pass" required>
                        <p class="mt-2">Ingrese los datos del administrador</p>
                        <button type="submit" value="registrar" name="accion" class="btn btn-dark">Registrar</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
</body>
</html>