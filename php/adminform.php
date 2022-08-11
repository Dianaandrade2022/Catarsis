<!-- php -->
<?php
if (isset($_SESSION['correo'])) {
  echo 
  '<script>
  alert("Ya tiene una cuenta como '.$_SESSION['correo'].'");
  window.location ="http://localhost/catarsis/index2.php";
  </script>';
  exit;
} 
else if(isset($_SESSION['correoadmin'])) {
    echo 
    '<script>
    alert("Ya tiene una cuenta administrador como'.$_SESSION['correoadmin'].'");
    window.location ="http://localhost/catarsis/indexcolaborador.php";
    </script>';
    exit();
  }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="short icon" href="../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Administrador</title>
</head>
<body>
    <!-- menu -->
    <nav class="menu">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="material-icons">menu</i>
        </label>
        <div>
        <a href="../index.php" class="enlace"><img src="../img/elementos/logohealthy.png" alt=""></a>
        </div>
        <ul class="Desplazable">
            <li><a href="../index.php"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="../user/sobre.php"><i class="material-icons">people</i>Sobre Nosotros</a></li>
            <li>
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Mas 
               </button>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                 <li><a class="dropdown-item" href="../user/plan.php"><i class="material-icons">assessment</i>Ver planes</a></li>
                 <li><a class="dropdown-item" href="../login/registro.php"><i class="material-icons">person</i>Iniciar Sesion</a></li>
                 <li><a class="dropdown-item" href="../user/psicologos.php"><i class="material-icons">person_pin_circle</i>Ver psicologos</a></li>
                 <li><a class="dropdown-item" href="adminform.php"><i class="material-icons">https</i>Iniciar como admin</a></li>
               </ul>
            </li>
        </ul>
        <div class="usuario">
            <a href="../login/registro.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="../login/registro.php" style="text-decoration: none; line-height: 80px;"><h3> Iniciar Sesion</h3></a>
        </div>
    </nav>

            <div class="containerbody">
            <div class="pt-3">
                <h2 class="text-center text-primary">Iniciar sesión como administrador de la página</h2>
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
                    <h3>Inicia Sesión</h3>
                    <P>Si no cuentas con tus datos ponte en contacto con el administrador</P>
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

                <form action="../login/php/admin_be.php" class="form_login" method="POST">
                    <h2>Iniciar sesión</h2>
                    <input type="email" placeholder="Correo electronico" name="correo" required>
                    <div class="group">
                    <input type="password" placeholder="Contraseña" name="pass" required>
                    </div>
                    <button type="submit" value="iniciarsesion" name="accion" class="btn btn-dark">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/script.js"></script>
    <script src="../js/registro.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>