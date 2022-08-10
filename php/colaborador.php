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

//con ello seleccionamos el id de la persona que esta logueada y completo el formulario previo
$resultid = $con -> prepare("SELECT id_persona,id_usuario FROM persona WHERE id_usuario = '$id'");
$resultid -> execute();
$resultid =  $resultid->fetch(PDO::FETCH_ASSOC);

if (isset($resultid['id_persona'])) {
    $varid = $resultid['id_persona'];
} else{
    $_SESSION['mensaje'] =
    '<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
    Primero rellene datos de complemento
    </div>
  </div>';
    header("location:complementar.php");
    exit;
}
//verificar datos 
$query = $con -> prepare ("SELECT * FROM colaborador inner join persona on persona.id_usuario ='.$id.' AND colaborador.id_persona = persona.id_persona");
$query ->execute();
$resultado = $query ->rowCount();
if ($resultado>0) {
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
      <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>
    <link rel="short icon" href="../img/iconos/icon.png">
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
                <h1 class="text-center f">Requisitos</h1>
                <?php
                        if(isset($_SESSION['envia'])){
                        echo $_SESSION['envia'];
                        unset ($_SESSION['envia']);

                     }
                        ?>
                <p class="text-muted text-center h6">Para colaborar con healthymind necesitamos que envie su solicitud rellenando los siguientes datos y sea aceptado para empezar a trabajar con nosotros, por favor rellene todos los campos solicitados.</p>
            </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="" class="form-label">Cedula:</label>
                <input type="file" name="cedula" class="form-control" required>
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="" class="form-label">Curp:</label>
                    <input type="text" name="curp" class="form-control" minlength="18" maxlenght="18" onKeyUp="mayus(this);" required>
                </div>
                <div class="form-group col col-12 mb-2">
                    <label for="" class="form-label" class="col-3">Descripción de tu perfil:</label>
                    <textarea name="descripcion" cols="30" rows="3" class="form-control mb-1"  required></textarea>
                </div>
                <div class="form-group col col-12 mb-2">
                    <label for="" class="form-label" class="col-3">Precio por sesión:</label>
                    <input type="number" step="any" class="form-control" placeholder="Precio en pesos MXN" name="precio" id="precio" required>
                </div>
                <div class="form-group col col-5 mb-2">
                    <label for="" class="form-label" class="col-3">Inicio laborando:</label>
                    <input type="date" class="form-control" name="años" required>
                </div>
                <div class="form-group col col-5 mb-3">
                    <label for="" class="form-label" class="col-3" required>Metodo de consulta:</label>
                    <select name="tipoconsulta" id="" class="form-control" required>
                        <option value="Videollamadas">Videollamadas</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Hibrido">Hibrido</option>
                    </select>
                </div>
                <div class="form-group col col-4 mb-3">
                    <label for="" class="form-label" class="col-3">Educación:</label>
                    <input type="text" class="form-control"  name="educacion" required>
                </div>
                <div class="form-group col col-4 mb-3">
                    <label for="" class="form-label" class="col-3">Especialidad:</label>
                    <input type="text" class="form-control" name="especialidad" required>
                </div>
                <div class="form-group col col-4 mb-3">
                    <label for="" class="form-label" class="col-3">Ubicación:</label>
                    <input type="text" class="form-control" name="ubicacion" placeholder="Calle # Colonia" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="" class="form-label">Certificado:</label>
                <input type="file" name="certificado" class="form-control" required>
                </div>
                <div class="col col-12 mb-3">
                <button class="btn btn-dark">Enviar</button>
                <input type="reset" class="btn btn-dark">
                </div>
        </div> 
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