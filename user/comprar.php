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
    <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Premium formulario</title>
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
               </ul></li>
      </ul>
   <div class="usuario">
            <a href="perfil.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="perfil.php" style="text-decoration: none;"><h3 class="h1 text-capitalize"><?php echo $user?></h3></a>
        </div>
    </nav>
<?php
$baseUrl = 'http://localhost/catarsis/php';
?>

<div class="container mt-3">


<h1 class="text-center" style="font-variant: small-caps;">Formulario de pago</h1>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_pay">

<!-- Valores requeridos -->
<input class="form-control" type="hidden" name="business" value="sb-lwo9t19968272@business.example.com">
<input class="form-control" type="hidden" name="cmd" value="_xclick">

<div class="form-group mb-4">
<label for="item_name" class="form-label">Plan</label>
<select class="form-control" type="text" name="item_name" id="item_name">
  <option value="Premium">Premium</option>
</select>
</div>
<div class="form-group mb-4">
<label for="amount" class="form-label">amount</label>
<select class="form-control" type="text" name="amount" id="amount">
  <option value="259.99">259.99</option>
</select>
</div>

<input class="form-control" type="hidden" name="currency_code" value="MXN">
<label for="correo" class="form-label">Correo de respaldo</label>
<input class="form-control" type="text" name="correo" id="correo" required><br>

<!-- Valores opcionales -->
<!-- https://developer.paypal.com/docs/paypal-payments-standard/integration-guide/Appx-websitestandard-htmlvariables/ -->

<input class="form-control" type="hidden" name="item_number" value="1">
<!-- <input class="form-control" type="hidden" name="invoice" value="0012"> -->

<input class="form-control" type="hidden" name="shipping" value="250.99">
<input class="form-control" type="hidden" name="return" value="<?= $baseUrl ?>/receptor.php">
<input class="form-control" type="hidden" name="cancel_return" value="<?= $baseUrl ?>/plan.php">

<hr>

<button type="submit" class="btn btn-primary"><i class="fa-brands fa-paypal"></i> Pagar con Paypal</button>

</form>
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>