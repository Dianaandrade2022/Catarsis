<?php
session_start();


require_once '../login/php/conexion.php';
require '../config/prueba.php';
$database = new database(); 
$con = $database->conectar();
  

    $sql = $con ->prepare("SELECT * FROM colaborador col INNER JOIN persona per ON col.id_persona = per.id_persona WHERE `admin` = 1;");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- iconos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="short icon" href="../img/iconos/icon.png"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/psicologos.css">
    <title>Psicologos</title>
</head>
<body>
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
                 <li><a class="dropdown-item" href="../php/adminform.php"><i class="material-icons">https</i>Iniciar como admin</a></li>
               </ul>
            </li>
        </ul>
        <div class="usuario">
            <a href="../login/registro.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="../login/registro.php" style="text-decoration: none; line-height: 80px;"><h3> Iniciar Sesion</h3></a>
        </div>
    </nav>
    
    <!-- menu -->
        <!-- CONTENIDO -->
        <div class="info">
                <h2 class="text-center text-light bg-dark pt-3 pb-3 display-5" style="width:100vw; font-variant:small-caps;">Psicologos</h2>
            </div>
        <div class="container">
        <?php
            if ($resultado==null) {
                $_SESSION['data'] ='<div class="justify-content-center row m-5">
                <div class="alert alert-secondary justify-content-center opacity-75 w-100 m-2 mt-3 col p-5 col-12" role="alert">
                   <div class="p-3">
                   <p class ="text-center display-4 "> Aún no hay colaboradores </p>
                   </div>
                 </div>
                </div>';
            }
            if(isset($_SESSION['data'])){
                echo $_SESSION['data'];
                unset ($_SESSION['data']);
             }
            ?>
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
                    <img src="<?php echo $img?>" alt="" class="card-img-top img-rounded" style="width:20vw; margin:auto;">
                        <div class="card-body">
                        <h5 class="card-title text-primary text-uppercase"><i class="material-icons">assignment_ind</i>nombre: <?php echo $row['nombre'];echo ' '; echo $row['ApellidoP'];echo ' ';  echo $row['ApellidoM']?></h5>
                        <p><i class="material-icons">location_on</i>Ubicación: <?php echo $row['ubicacion']?></p>
                        <p class="text-capitalize"><i class="material-icons">business_center</i>Sesiones en: <?php echo $row['metodo']?></p>
                        <p><i class="material-icons">credit_card</i>Precio estandar: <?php echo number_format($row['precio'],2,'.',',');?></p>
                        <div class="text-truncate">
                        <p class="card-text col-8 text-truncate text-lowercase"><?php echo $row['descripcion']?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3">
                        <a class="d-block rounded-sm btn border-primary" href="detallespsicologos.php?id=<?php echo $row['id_colaborador']; ?>&token=<?php echo hash_hmac('sha512', $row['id_colaborador'],KEY_TOKEN);?>">Ver más</a>
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