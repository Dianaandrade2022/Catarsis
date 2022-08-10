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
//verificar datos 
$query = $con -> prepare ("SELECT * FROM colaborador inner join persona on persona.id_usuario ='.$id.' AND colaborador.id_persona = persona.id_persona");
$query ->execute();
$resultado = $query ->rowCount();
if ($resultado>0) {
}else{
    header("location:colaboradorshow.php");
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
    <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/colaborador.css">
    <title>Colaborador solicitud</title>
</head>
<body>
    <!-- menu -->
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
            <li><a href="../php/sobre.php"><i class="material-icons">people</i>Sobre Nosotros</a></li>
            <li><a href="../php/configuracionuser.php"><i class="material-icons">dvr</i>Contacto</a></li>
     <li><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
       Mi perfil
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="../php/complementar.php"><i class="material-icons">add</i>Complementar datos</a></li>
        <li><a class="dropdown-item" href="../php/test.php"><i class="material-icons">streetview</i>Contestar test</a></li>
        <li><a class="dropdown-item" href="../php/perfil.php"><i class="material-icons">remove_red_eye</i>Ver perfil</a></li>
        <li><a class="dropdown-item" href="../php/configuracionuser.php"><i class="material-icons">settings</i>Configuracion</a></li>  
      </ul></li>
      <li>
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Mas 
               </button>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                 <li><a class="dropdown-item" href="../php/plan.php"><i class="material-icons">assessment</i>Ver planes</a></li>
                 <li><a class="dropdown-item" href="../login/php/cerrarsesion.php"><i class="material-icons">person</i>Cerrar Sesion</a></li>
                 <li><a class="dropdown-item" href="../php/psicologos.php"><i class="material-icons">person_pin_circle</i>Ver psicologos</a></li>
                 <li><a class="dropdown-item" href="mostrar.php"><i class="fa-solid fa-comment-check"></i>Ver test</a></li>

               </ul></li>
      </ul>
   <div class="usuario">
            <a href="../php/perfil.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="../php/perfil.php" style="text-decoration: none;"><h3 class="h1 text-capitalize"><?php echo $user?></h3></a>
        </div>
    </nav>
<!-- menu -->
<div class="container">
    <form action="../login/php/solicitud.php" class="form-row p-2 mt-3" method="POST">
        <div class="row p-2">
            <div class="col col-12 p-3">
                <h1 class="text-center text-success text-uppercase">Requisitos</h1>
                <?php
                        if(isset($_SESSION['envia'])){
                        echo $_SESSION['envia'];
                        unset ($_SESSION['envia']);

                     }
                        ?>
                <p class="text-muted text-center h6">Sus datos se han enviado ahora espere a que sean aceptados. ✔️✔️</p>
            </div>
            <?php 
            foreach ($query as $row ) {
            
            ?>
                <div class="form-group col-md-6 mb-2">
                    <label for="" class="form-label">Cedula:</label>
                <input type="text" name="cedula" class="form-control bg-light" value ="<?php echo $row['cedula']?>"disabled>
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="" class="form-label">Curp:</label>
                    <input type="text" name="curp" class="form-control bg-light" minlength="18" maxlenght="18" onKeyUp="mayus(this);" disabled value="<?php echo $row['Curp']?>">
                </div>
                <div class="form-group col col-12 mb-2">
                    <label for="" class="form-label" class="col-3">Descripción de tu perfil:</label>
                    <textarea name="descripcion" cols="30" rows="3" class="form-control bg-light mb-1"  placeholder="<?php echo $row['descripcion']?>" disabled></textarea>
                </div>
                <div class="form-group col col-12 mb-2">
                    <label for="" class="form-label" class="col-3">Precio por sesión:</label>
                    <input type="number" step="any" class="form-control bg-light" placeholder="Precio en pesos MXN" name="precio" id="precio" value="<?php echo $row['precio']?>" disabled>
                </div>
                <div class="form-group col col-5 mb-2">
                    <label for="" class="form-label" class="col-3">Inicio laborando:</label>
                    <input type="date" class="form-control bg-light" name="años" value="<?php echo $row['experiencia']?>" disabled>
                </div>
                <div class="form-group col col-5 mb-3">
                    <label for="" class="form-label" class="col-3" disabled>Metodo de consulta:</label>
                    <input type="text" class="form-control bg-light" value="<?php echo $row['metodo']?>" disabled>
                </div>
                <div class="form-group col col-4 mb-3">
                    <label for="" class="form-label" class="col-3">Educación:</label>
                    <input type="text" class="form-control bg-light"  name="educacion" value="<?php echo $row['educacion']?>" disabled>
                </div>
                <div class="form-group col col-4 mb-3">
                    <label for="" class="form-label" class="col-3">Especialidad:</label>
                    <input type="text" class="form-control bg-light" name="especialidad" value="<?php echo $row['especialidad']?>" disabled>
                </div>
                <div class="form-group col col-4 mb-3">
                    <label for="" class="form-label" class="col-3">Ubicación:</label>
                    <input type="text" class="form-control bg-light" name="ubicacion" placeholder="Calle # Colonia" value="<?php echo $row['ubicacion']?>" disabled>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="" class="form-label">Certificado:</label>
                <input type="text" name="certificado" class="form-control bg-light" value="<?php echo $row['certificado']?>" disabled>
                </div>
                <div class="col col-12 mb-3">
                </div>
        </div> 
        <?php
        }
        ?>
    </form>
    </div>
    <script>
        function mayus(e){
            e.value = e.value.toUpperCase();
        }
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>