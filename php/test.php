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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://kit.fontawesome.com/6368fe8576.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="short icon" href="../img/iconos/icon.png">
    <title>Test diario</title>
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
        <li><a class="dropdown-item" href="mostrar.php"><i class="fa-solid fa-comment-check"></i>Ver test</a></li>

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
    <!-- menu -->

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-sentimientos-tab" data-bs-toggle="tab" data-bs-target="#nav-sentimientos" type="button" role="tab" aria-controls="nav-sentimientos" aria-selected="true">sentimientos</button>
      <button class="nav-link" id="nav-emociones-tab" data-bs-toggle="tab" data-bs-target="#nav-emociones" type="button" role="tab" aria-controls="nav-emociones" aria-selected="false">emociones</button>
      <button class="nav-link" id="nav-estres-tab" data-bs-toggle="tab" data-bs-target="#nav-estres" type="button" role="tab" aria-controls="nav-estres" aria-selected="false">estres</button>
      <button class="nav-link" id="nav-sue??o-tab" data-bs-toggle="tab" data-bs-target="#nav-sue??o" type="button" role="tab" aria-controls="nav-sue??o" aria-selected="false" >sue??o</button>
      <button class="nav-link" id="nav-motivacion-tab" data-bs-toggle="tab" data-bs-target="#nav-motivacion" type="button" role="tab" aria-controls="nav-motivacion" aria-selected="false" >motivacion</button>
    </div>
  </nav>

  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-sentimientos" role="tabpanel" aria-labelledby="nav-sentimientos-tab" tabindex="0">
     <div class="contenedorplantilla">
        <div class="contenedorcard">
     <div class="mb-6">
     <h1 class="text-align-center">??Como te sientes hoy?</h1>
     <?php
                        if(isset($_SESSION['mensaje'])){
                        echo $_SESSION['mensaje'];
                        //evita que aparezca siempre
                        unset ($_SESSION['mensaje']);

                     }
                        ?>
    <form action="../login/php/sentimientos_be.php" method="POST">
              <div class="card">
                            <div class="card-body">
                              <input type="radio" id="Amor" name ="sentimiento" value="Amor">
                              <label for="Amor" class="labeltest">Amor</label>
                              <img src="../img/testc/Amor.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <input type="radio" id="Perdido" name ="sentimiento" value="Perdido">
                                <label for="Perdido" class="labeltest">Perdido</label>
                                <img src="../img/testc/Perdida.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                              <input type="radio" id="Odio" name ="sentimiento" value="Odio">
                              <label for="Odio" class="labeltest">Odio</label>
                              <img src="../img/testc/Odio.png" alt="" class="card-img-top">
                          </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                              <input type="radio" id="Felicidad" name ="sentimiento" value="Felicidad">
                              <label for="Felicidad" class="labeltest">Felicidad</label>
                              <img src="../img/testc/Felicidad.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <button>enviar</button>
                </form>
</div> <div class="descripcion">
                  <h1 class="text-align-center">Sentimientos</h1>
                      <h5>En este apartado por favor deberas seleccionarlos como te sientes hoy</h5>
                      <h6>Un sentimiento es una experiencia mental que surge de la interpretacion del estado en el que se encuentra nuestro cuerpo.
                        Estas experiencias van apareciendo a medida que el cerebro va procesando las emociones. <br>
                        Para muchos especialistas, los sentimientos son la evaluacion que hacemos de una emocion, por tanto, interviene un factor cognitivo que no esta presente en las emociones.
                        <br>
                        Si una persona siente una emocion como el miedo, un sentimiento asociado puede ser el sufrimiento, al ver que el miedo la paralio y le impidio responder de una forma mas oportuna.
                      </h6>
                </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-emociones" role="tabpanel" aria-labelledby="nav-emociones-tab" tabindex="0"> <div class="contenedorplantilla">
        <div class="contenedorcard">
     <div class="mb-3">
     <h1 class="text-align-center">??Que emociones presentas?</h1>
    <form action="../login/php/emociones_be.php" method="POST">
              <div class="card">
                            <div class="card-body">
                              <input type="radio" id="alegria" name ="emociones" value="alegria">
                              <label for="alegria" class="labeltest">Alegria</label>
                              <img src="../img/testc/img5.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <input type="radio" id="tristeza" name ="emociones" value="tristeza">
                                <label for="tristeza" class="labeltest">Tristeza</label>
                                <img src="../img/testc/img2.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                              <input type="radio" id="miedo" name ="emociones"  value="miedo">
                              <label for="miedo" class="labeltest">Miedo</label>
                              <img src="../img/testc/img1.png" alt="" class="card-img-top">
                          </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                              <input type="radio" id="ira" name ="emociones" value="ira">
                              <label for="ira" class="labeltest">Ira</label>
                              <img src="../img/testc/img3.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <button>Enviar</button>
                </form>
</div> <div class="descripcion">
                  <h1 class="text-align-center">Emociones</h1>
                      <h5>En este apartado por favor deberas seleccionarlos como te sientes hoy</h5>
                      <h6>Una emoci??n es una respuesta biol??gica, espec??ficamente de car??cter neuronal, que desencadena una serie de reacciones qu??micas que alteran la forma como nos sentimos. <br>
                      Las emociones son la forma en la que nuestro cuerpo responde ante los est??mulos, bien sean t??ctiles, auditivos, visuales, olfativos o gustativos. <br>
                      Si una persona percibe olor a humo mientras duerme, probablemente piense que se trate de un problema en la cocina o del inicio de un incendio, as?? que seguramente sentir?? miedo.
                      <br> Esta emoci??n generar?? una serie de reacciones en cadena comandadas por el cerebro, que incluyen la adrenocorticotropa, una hormona encargada de aumentar la producci??n de la hormona cortisol, que a su vez aumenta los niveles de insulina en la sangre de una forma de generar energ??a para preparar el cuerpo para la huida.
                      </h6>
                </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-estres" role="tabpanel" aria-labelledby="nav-estres-tab" tabindex="0">
     <div class="contenedorplantilla">
        <div clatestc/>
     <div class="mb-3">
    <form action="../login/php/estres_be.php"  method="POST">
              <div class="card">
                            <div class="card-body">
                              <input type="radio" id="agudo" name ="estres" value="agudo">
                              <label for="agudo" class="labeltest">Estr??s agudo</label>
                              <img src="../img/testc/EstresAgudo.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <input type="radio" id="episodico" name ="estres" value="episodico">
                                <label for="episodico" class="labeltest">Estr??s agudo epis??dico</label>
                                <img src="../img/testc/EstresAgudoE.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                              <input type="radio" id="cronico" name ="estres" value="cronico">
                              <label for="cronico" class="labeltest">Estr??s cr??nico</label>
                              <img src="../img/testc/EstresCronico.png" alt="" class="card-img-top">
                          </div>
                        </div>
                        <button>Enviar</button>
                </form>
</div> <div class="descripcion">
                  <h1 class="text-align-center">Estr??s</h1>
                      <h5>En este apartado por favor deberas seleccionarlos como te sientes hoy</h5>
                      <h6>Los distintos tipos de estr??s. <br> El manejo del estr??s puede resultar complicado y confuso porque existen diferentes tipos de estr??s:<br>
                         1. Estr??s agudo: <br> El estr??s agudo es la forma de estr??s m??s com??n. <br> Surge de las exigencias y presiones del pasado reciente y las exigencias y presiones anticipadas del futuro cercano. <br>           
                         2. Estr??s agudo epis??dico: <br> Por otra parte, est??n aquellas personas que tienen estr??s agudo con frecuencia, cuyas vidas son tan desordenadas que son estudios de caos y crisis.<br>
                         3. Estr??s cr??nico: <br> Si bien el estr??s agudo puede ser emocionante y fascinante, el estr??s cr??nico no lo es. Este es el estr??s agotador que desgasta a las personas d??a tras d??a, a??o tras a??o.<br>
                      </h6>
                </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-sue??o" role="tabpanel" aria-labelledby="nav-sue??o-tab" tabindex="0">
     <div class="contenedorplantilla">
        <div class="contenedorcard">
     <div class="mb-3">
    <form action="../login/php/sue??o_be.php"  method="POST">
              <div class="card">
                            <div class="card-body">
                              <input type="radio" id="insomnio" name ="sue??o" value="insomnio">
                              <label for="insomnio" class="labeltest">Insomnio</label>
                              <img src="../img/testc/Insomnio.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <input type="radio" id="temord" name ="sue??o" value="temor">
                                <label for="temord" class="labeltest">Temor al dormir</label>
                                <img src="../img/testc/TemorDormir.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                              <input type="radio" id="levantarsemal" name ="sue??o" value="mal humor">
                              <label for="levantarsemal" class="labeltest">Levantarse con mal humor</label>
                              <img src="../img/testc/MalHumor.png" alt="" class="card-img-top">
                          </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                              <input type="radio" id="rigidez" name ="sue??o" value="rigidez">
                              <label for="rigidez" class="labeltest">Rigidez Muscular</label>
                              <img src="../img/testc/RigidezMuscular.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <button>Enviar</button>
                </form>
</div> <div class="descripcion">
                  <h1 class="text-align-center">Sue??o</h1>
                      <h5>En este apartado est??n los problemas m??s recurrentes a la hora de sue??o por favor seleccionar cuales padeces</h5>
                      <h6>
                        Es el transtorno de sue??o m??s frecuente en la poblaci??n general. <br>Consiste en una reducci??n de la capacidad para dormir, pudiendo manifestarse de diversos modos que dan lugar a diferentes tipos de insomnio: <br>
                        <h5>Insomnio de inicio: </h5> problemas para iniciar el sue??o en menos de 30 minutos. <br>
                        <h5>Insomnio de mantenimiento:</h5> Problemas para mantener el sue??o, produci??ndose despertares nocturnos de m??s de 30 minutos de duraci??n, o despertando definitivamente de manera precoz consiguiendo un tiempo total de sue??o escaso. <br>
                        La falta de sue??o puede afectar de modo negativo a la vida de la persona que lo sufre, provocando deterioro social, ocupacional o de otras ??reas importantes.
                      </h6>
                </div>
        </div>
      </div>
    </div>
    
    <div class="tab-pane fade" id="nav-motivacion" role="tabpanel" aria-labelledby="nav-motivacion-tab" tabindex="0">  <div class="contenedorplantilla">
        <div class="contenedorcard">
     <div class="mb-3">
    <form action="../login/php/motivacion_be.php"  method="POST">
              <div class="card">
                            <div class="card-body">
                              <input type="radio" id="extrinseca" name ="motivacion" value="extrinseca">
                              <label for="extrinseca" class="labeltest">Extr??nseca</label>
                              <img src="../img/testc/MotivacionE.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <input type="radio" id="intrinseca" name ="motivacion" value="intrinseca">
                                <label for="intrinseca" class="labeltest">Intr??nseca</label>
                                <img src="../img/testc/MotivacionI.png" alt="" class="card-img-top">
                            </div>
                        </div>
                        <button>Enviar</button>
                </form>
</div> <div class="descripcion">
                  <h1>Sentimientos</h1>
                      <h5>En este apartado por favor deberas seleccionarlos como te sientes hoy</h5>
                      <h6>Un sentimiento es una experiencia mental que surge de la interpretacion del estado en el que se encuentra nuestro cuerpo.
                        Estas experiencias van apareciendo a medida que el cerebro va procesando las emociones. <br>
                        Para muchos especialistas, los sentimientos son la evaluacion que hacemos de una emocion, por tanto, interviene un factor cognitivo que no esta presente en las emociones.
                        <br>
                        Si una persona siente una emocion como el miedo, un sentimiento asociado puede ser el sufrimiento, al ver que el miedo la paralio y le impidio responder de una forma mas oportuna.
                      </h6>
                </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
