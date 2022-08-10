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

  $persona = $con -> prepare ("SELECT count(id_persona) FROM persona WHERE id_usuario = '$id'");
  $persona ->execute();
  if ($persona->fetchColumn()>0) {
     } else{
      header("location:perfil2.php");
     }

$query = $con ->prepare("SELECT Fecha_Nacimiento, foto_perfil FROM persona WHERE id_usuario = '.$id.' ");
$query -> execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);
$sql = $con->prepare("SELECT sentimientos.sentimiento,sentimientos.fecha,
motivacion.motivacion,motivacion.fecha,
estres.estres,estres.fecha,
dormir.dormir,dormir.fecha,
emociones.emocion,emociones.fecha
FROM usuario
INNER JOIN sentimientos ON usuario.id_usuario =   sentimientos.id_usuario
INNER JOIN motivacion ON usuario.id_usuario =  motivacion.id_usuario
INNER JOIN estres ON usuario.id_usuario = estres.id_usuario
INNER JOIN dormir ON usuario.id_usuario = dormir.id_usuario
INNER JOIN emociones ON usuario.id_usuario = emociones.id_usuario
WHERE usuario.id_usuario =  '$id'");

            $sql -> execute();
            while ($fila = $sql->fetch(PDO::FETCH_BOTH)) {
                $arreglo []= $fila;
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/mostrar.css">
    <title>Mi perfil</title>
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

    <div class="content justify-content-center m-4">
        <div class="card mt-3 border-0 col-12">
            <h3 class="card-title text-center p-1 border-0">Test Diario</h3>
            <p class="body-text text-center">Datos seleccionados</p>
        </div>
     <div class="row justify-content-center">
   
    <table id="test" class="m-2 p-1 table border justify-content-center" width="100%">

        <thead>
            <tr>
                <th class="text-center">Fecha</th>
                <th class="text-center">Sentimiento</th>
                <th class="text-center">Motivacion</th>
                <th class="text-center">Estrés</th>
                <th class="text-center">Sueño</th>
                <th class="text-center">Emoción</th>
            </tr>
        </thead>
        
        <tbody>
        <?php 
        if (isset($arreglo)) {
            if ($arreglo =='') {
                echo 
                 $_SESSION['actualizav'] =
                 '<div class="alert alert-secondary d-flex align-items-center mt-3 justify-conten-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Secondary:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        No ah respondido la encuesta
        </div>
      </div>';
             }
        
        else{
    foreach ($arreglo as $row) {
        ?>
            <tr>
                <td class="text-center bg-light"><?php echo $row['1']?></td>
                <td class="text-center"><?php echo $row['0']?></td>
                <td class="text-center"><?php echo $row['2']?></td>
                <td class="text-center"><?php echo $row['4']?></td>
                <td class="text-center"><?php echo $row['6']?></td>
                <td class="text-center"><?php echo $row['8']?></td>

            </tr>
            <?php       
}}
}else{
    $_SESSION['data'] ='<div class="justify-content-center row m-5">
                <div class="alert alert-secondary justify-content-center opacity-75 w-100 m-2 mt-3 col p-5 col-12" role="alert">
                   <div class="p-3">
                   <p class ="text-center display-4 "> Aún no respondes el test </p>
                   </div>
                 </div>
                </div>';
}
?>
        </tbody>
        
</table>
<?php
 
 if(isset($_SESSION['data'])){
    echo $_SESSION['data'];
    unset ($_SESSION['data']);
 }
?>
     </div>
     <button id="btn1" class="btn btn-dark m-2 mt-1">Clon</button>
    </div>
    <!--------------------------------------------------------- Fin apartado -------------------------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script> 

<script>
let temp = $("#btn1").clone();
$("#btn1").click(function(){
    $("#btn1").after(temp);
});

$(document).ready(function(){
    var table = $('#test').DataTable({
       orderCellsTop: true,
       fixedHeader: true 
    });

    $('#test thead tr').clone(true).appendTo( '#test thead' );

    $('#test thead tr:eq(1) th').each( function (i) {
        var title = $(this).text(); 
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );   
});

</script>
        
</body>
</html>