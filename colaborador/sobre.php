<!-- php -->
<?php
session_start();

if (!isset($_SESSION['correocol'])) {
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
    <link rel="stylesheet" href="../css/about.css">
    <title>Sobre nosotros</title>
</head>
<body>

       
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
<!-- menu -->
        <!-- Slider -->
        <div id="info" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#info" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#info" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#info" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
         <div class="carousel-item active" data-bs-interval="10000">
            <img src="../img/elementos/banner.png" class="d-block w-100 h-vh" alt="info-">
            <div class="carousel-caption d-md-block d-sm-block">
                <h2 class="slidert">Objetivo Organizacional</h2>
                <p style="font-size:1vw;">Contar con profesionales que ayuden a reducir el porcentaje de las
              enfermedades como depresión, estrés y ansiedad. Así ofrecer un
              espacio de atención, reflexión y análisis con los aspectos
              relacionados con el comportamiento, familia, la salud mental, la
              comunidad y el desarrollo de todas las variables psicológicas que
              inciden en el desarrollo personal.</p>
            </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
            <img src="../img/elementos/bannerG.png" class="d-block w-100 h-vh" alt="info-">
            <div class="carousel-caption d-md-block d-sm-block">
                <h2 class="slidert">MISIÓN</h2>
                <p style="font-size:1vw;">Nuestra estrategia es hacer crecer el negocio a nivel local y
                regional, para mejorar la experiencia del
                cliente con un enfoque en cuidar la salud de aquellas personas que
                necesiten un apoyo emocional, compartir nuestro propósito con el
                público y extender nuestro servicio de transmisión.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="../img/elementos/banner3_1.png" class="d-block w-100 h-vh" alt="info-">
            <div class="carousel-caption d-md-block d-sm-block">
                <h2 class="slidert">Visión</h2>
                <p style="font-size:1vw;">Nos vemos a futuro como una empresa capaz de renovarse a sí misma
                para poder ofrecer nuestros servicios y que estos sean cada vez más
                precisos, eficientes y tecnológicos. Buscamos crear una página capaz
                de brindar un diagnóstico tan preciso y verídico como ningún otro,
                igualmente buscamos implementar profesionales de nivel regional o
                nacional para brindar un servicio de calidad.</p>
            </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#info" data-bs-slide="prev">
            <span class="control"><i class="material-icons">fast_rewind</i></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#info" data-bs-slide="next">
            <span class="control"><i class="material-icons">fast_forward</i></span>
        </button>
        </div>
<!-- Fin slider -->

<h1 class="mt-4">¿Quienes Somos?</h1>
<p>
    Healthy mind es una empresa dedicada al area del cuidado de la salud mental, enfocandonos en el bienestar de los usuarios que se unen a nuestro sitio web. Responsabilidad, puntualidad y compromiso son nuestros tres pilares que nos caracterizan como una empresa unica y de calidad.
</p>
<p>Tenemos puestas todas nuestras esperanzas en que en un futuro proximo nuestra pagina web llegara a todos los lugares, ayudando a el grupo de personas mas vulnerables</p>
<!-- Valores -->
<div class="container">
  <div class="row" id="funcion">
  <div class="card col col-12" id="comofunciona">
    <h3 class="title-card text-center mt-4">¿Cómo funciona?</h3>
    <p class="text-card text-start">Podrás visualizar el contenido de nuestra página pero si quieres acceder a ciertas funcionalidades necesitaras registrarte para poder almacenar tu información. Y a esto puedes obtener más beneficios si decides comprar la parte premium. Sin embargo contamos con 2 tipos de usuario y con ello distinto contenido.</p>
  </div>
  
    <div class="card col mt-4 col-6 border-0">
      <h2 class="title-card text-center text-primary">Colaborador</h2>
      <p class="text-card" style="font-size:1.3vw;">Necesitaras rellenar un formulario para completar tus datos y seleccionar el tipo de usuario colaborador. Este te brinda participar con healthymind es decir podrás ser uno de los profesionales que brinda su servicio a través de nuestra página web, sin embargo estos datos no afirman que serás aceptado solo es un requisito para poder solicitar ser colaborador. Por consiguiente tienes que rellenar el formulario de ser colaborador donde adjuntas tus archivos y por consiguiente esperar a que tu solicitud sea aceptada y poder brindar tus servicios.</p>
    </div>
    <div class="card col mt-4 col-6 border-0">
      <h2 class="title-card text-center text-primary">Paciente</h2>
      <p class="text-card" style="font-size:1.3vw;">Tienes acceso a nuestro test diario una ves que ingreses sesión donde podrás llevar un analísis de cerca al igual si decides unirte a la parte premium puedes contactar con un profesional y llevar dado caso un tratamiento y tener el tipo de consulta de acuerdo a tus disposiciones y necesidades.</p>
    </div>
  </div>
</div>
<div class="container">
    <h1 class="mt-3">Fortalezas</h1>
<div class="contenedorcard row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <div class="card bg-transparent" style="width: 18rem;">
        <img src="../img/elementos/apoyo.jpg" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text" >Brindar un apoyo psicológico para todo el público
                        y adaptándonos a la disposición de este.</p>
        </div>
      </div>

      <div class="card bg-transparent" style="width: 18rem;">
        <img src="../img/elementos/trabajar.jpg" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text">En conjunto con la tecnología permitimos un fácil
            acceso a ayuda psicológica</p>
        </div>
      </div>
        

      <div class="card bg-transparent" style="width: 18rem;">
        <img src="../img/elementos/team.jpg" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text">Recursos de ayuda con profesionales</p>
        </div>
      </div>

      <div class="card bg-transparent" style="width: 18rem;">
        <img src="../img/elementos/profesional.jpg" class="card-img-top" alt="">
        <div class="card-body">
          <p class="card-text">Citas programadas de acuerdo a las necesidades del cliente</p>
        </div>
      </div>
    </div>
    <h1>Oportunidades</h1>
    <div class="contenedorcard row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="card bg-transparent" style="width: 18rem;">
            <img src="../img/elementos/apoyo.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <p class="card-text">Citas programadas de acuerdo a las necesidades del cliente.</p>
            </div>
          </div>
    
          <div class="card bg-transparent" style="width: 18rem;">
            <img src="../img/elementos/estres.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <p class="card-text">Disminución del estrés.</p>
            </div>
          </div>
            
    
          <div class="card bg-transparent" style="width: 18rem;">
            <img src="../img/elementos/presion.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <p class="card-text">Afrontar presiones.</p>
            </div>
          </div>
    
          <div class="card bg-transparent" style="width: 18rem;">
            <img src="../img/elementos/saludfisica.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <p class="card-text">Buena salud física.</p>
            </div>
          </div>

          <div class="card bg-transparent" style="width: 18rem;">
            <img src="../img/elementos/saludmental.png" class="card-img-top" alt="">
            <div class="card-body">
              <p class="card-text">Mejor calidad de vida.</p>
            </div>
          </div>

      </div>
      </div>

 <!-- Bootstrap js -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>