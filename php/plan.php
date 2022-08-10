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
  exit;
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
    <link rel="stylesheet" href="../css/plan.css">
    <title>Planes</title>
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

    
    <div id="generic_price_table">   
        <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Cabecera-->
                            <div class="price-heading clearfix">
                                <h1>Seleccione el plan de su preferencia :</h1>
                            </div>
                            <!--//cabecera-->
                        </div>
                    </div>
                </div>
                <div class="container">
                    
                    <!--Bloque-->
                    <div class="row">
                        <div class="col-md-6">
                        
                            <!--Contenedor-->
                            <div class="generic_content clearfix">
                                <div class="generic_head_price clearfix">
                                    <div class="generic_head_content clearfix">
                                    
                                        <!--HEAD-->
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>Gratuito</span>
                                        </div>
                                        <!--//HEAD END-->
                                        
                                    </div>
                                    <!--//HEAD CONTENT END-->
                                    
                                    <!--PRICE START-->
                                    <div class="generic_price_tag clearfix">	
                                        <span class="price">
                                            <span class="sign">$</span>
                                            <span class="currency">0</span>
                                            <span class="cent"></span>
                                            <span class="month"></span>
                                        </span>
                                
                                    <!--//PRICE END-->
                                    
                                </div>                            
                                <!--//HEAD PRICE DETAIL END-->
                                
                                <!--FEATURE LIST START-->
                                <div class="generic_feature_list">
                                    <ul>
                                        <li><span></span> Test diario de estado emocional</li>
                                        <li><span></span> Verificar estado semanal de salud mental</li>
                                        <li><span></span> visualizar los factores afectables en su día a día</li>
                                        <li><span></span>Asistencia basica</li>
                                    </ul>
                                </div>
                
                                <br><br>
                                </div>
                                    <div class="generic_price_btn clearfix">
                                    <a class="" href="../index2.php">Continuar Gratis</a>
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="col-md-6">

                            <div class="generic_content clearfix">
                                
                                <div class="generic_head_price clearfix">
                                    <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>Unico pago</span>
                                        </div>
                                        
                                    </div>

                                    <div class="generic_price_tag clearfix">	
                                        <span class="price">
                                            <span class="sign">$</span>
                                            <span class="currency">250</span>
                                            <span class="cent">.99</span>
                                        </span>
                                    </div>
                                    
                                </div>                            
                    
                                <div class="generic_feature_list">
                                    <ul>
                                        <li><span></span> Accceso a todas las funciones de la página</li>
                                        <li><span></span> Solicitar ayuda externa con un profesional</li>
                                        <li><span></span> Eleccion del profesional que brindara la ayuda</li>
                                        <li><span></span> Riguroso control por parte de expertos</li>
                                        <li><span></span> Soporte a cualquier hora del día</li>
                                    </ul>
                                </div>
                    
                                <div class="generic_price_btn clearfix">
                                    <a class="" href="comprar.php">Obtener</a>
                                </div>
                             
                            </div>
                                
                        </div>
                    </div>	
                    
                </div>
            </section>
        </div>
    </div>
        <!-- Bootstrap js -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>