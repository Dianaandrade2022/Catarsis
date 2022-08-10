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
require '../../config/prueba.php';
$database = new database(); 
$con = $database->conectar();

$usuario = $_SESSION['correoadmin'];
$consul = $con -> prepare("SELECT nombre FROM administrador WHERE correo = '$usuario'");
$consul -> execute();
$consul =  $consul->fetch(PDO::FETCH_ASSOC);
if (isset($consul)) {
    $user = $consul['nombre'];
}
$sql = $con ->prepare("SELECT * FROM colaborador col INNER JOIN persona per ON col.id_persona = per.id_persona WHERE `admin` = 0");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- iconos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>
    <link rel="short icon" href="../../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">  
    <!-- estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/psicologos.css">
    <title>Verificar</title>
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
   <!-- CONTENIDO -->
   <div class="info">
                <h3 class="text-center text-light bg-dark pt-3 display-5 pb-3" style="font-variant:small-caps;">Psicologos</h3>
            </div>
        <div class="row justify-content-space-between flex m-2 p-2">
            <a href="aceptados.php" class="btn  btn-customize col p-3 m-2 display-5"><i class="fa-solid fa-user-check"></i> Aceptados</a>
            <a href="rechazados.php" class="btn  btn-customize col p-3 m-2 display-5"><i class="fa-solid fa-user-xmark"></i> Rechazados</a>
        </div>
        <div class="container">
           <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($resultado as $row){
            ?>
            <div class="col">
                <div class="card mt-3 p-2">
                   <?php
                   $id = $row['id_colaborador'];
                   $img = "img/$id/main.jpg";
                   if (!file_exists($img)) {
                    $img = "img/user.png";
                   }
                   ?>
                    <img src="<?php echo $img?>" alt="" class="card-img-top" style="width:20vw; margin:auto;">
                        <div class="card-body">
                        <h5 class="card-title text-primary text-uppercase"><i class="material-icons">assignment_ind</i>Nombre: <?php echo $row['nombre'];echo ' '; echo $row['ApellidoP'];echo ' ';  echo $row['ApellidoM']?></h5>
                        <p><i class="material-icons">location_on</i>Ubicación: <?php echo $row['ubicacion']?></p>
                        <p class="text-capitalize"><i class="material-icons">business_center</i>Sesiones en: <?php echo $row['metodo']?></p>
                        <p><i class="material-icons">credit_card</i>Precio estandar: <?php echo number_format($row['precio'],2,'.',',');?></p>
                        <div class="text-truncate">
                        <p class="card-text col-8 text-truncate text-lowercase"><?php echo $row['descripcion']?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3">
                        <a class="d-block rounded-sm btn btn-dark" href="detallesverificar.php?id=<?php echo $row['id_colaborador']; ?>&token=<?php echo hash_hmac('sha512', $row['id_colaborador'],KEY_TOKEN);?>">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }
            ?>
           </div> 
            
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>

