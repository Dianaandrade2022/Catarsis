<!-- php -->
<?php
if (isset($_SESSION['correo'])) {
  echo 
  '<script>
  alert("Ya tiene una cuenta como:'.$_SESSION['correo'].'");
  window.location ="index2.php";
  </script>';
  exit;
} 
else if(isset($_SESSION['correoadmin'])) {
    echo 
    '<script>
    alert("Ya tiene una cuenta administrador como: '.$_SESSION['correoadmin'].'");
    window.location ="../indexcolaborador.php";
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
    <!-- Iconos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="short icon" href="../img/iconos/icon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/emergente.css">
    <link rel="stylesheet" href="css/registro.css">
    <title>Registro</title>
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
            <a href="registro.php"><img src="../img/elementos/user.png" alt=""></a>
            <a href="registro.php" style="text-decoration: none; line-height: 80px;"><h3> Iniciar Sesion</h3></a>
        </div>
    </nav>
   
            <div class="containerbody">
    <!-- Empieza contenido -->
        <div class="contenedor_todo">

            <div class="cajatrasera">
                <div class="caja_traseralogin">
                    <h3>??Ya te has registrado?</h3>
                    <p>??Qu?? esperas?. Inicia Sesi??n Ahora</p>
                    <button id="btn_Login">Iniciar Sesi??n</button>
                </div>
                <div class="caja_delanteraregistro">
                    <h3>??No tienes una cuenta?</h3>
                    <P>Registrate ahora para obtener nuestros servicios</P>
                    <button id="btn_singup">Registrarse</button>
                </div>
            </div>

            <div class="loginregistro">

                <form action="php/iniciarsesion.php" class="form_login" method="POST">
                    <h2>Iniciar sesi??n</h2>
                    <input type="email" placeholder="Correo electronico" name="email" required>
                    <div class="group">
                    <input type="password" placeholder="Contrase??a" name="Contrasenia" required>
                    </div>
                    <button>Iniciar sesi??n</button>
                </form>

                <form action="php/registro_be.php" method="POST" class="form_registrar">
                        <h2>Registrarse</h2>
                        <input type="text" placeholder="Usuario" name="usuario" required>
                        <input type="email" placeholder="Correo electronico" name="email" required>
                        <input type="password" placeholder="Contrase??a" name="Contrasenia" required>
                        <p>Al registrarse acepta terminos y condiciones</p>
                        <a href="#" class="Terminos">
                        <p style = "font-size:13px; color:gray;"id="btn-abrir-popup" class="btn-abrir-popup">Leer m??s</p></a>  
                        <br>
                        <button>Registrar</button>
                        <p>??La importancia de estar bien!</p>
                </form>
                
                </div>
            </div>
            <div class="overlay" id="overlay">
			<div class="popup justify-content-start" id="popup" style="overflow-y:scroll; height: 600px; -webkit-scrollbar-thumb:background-color:black;">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="material-icons">clear</i></a>
				<h1>T??rminos y servicios</h1><br>
                                    <p>Lea detenidamente los presentes T??rminos y Condiciones que rigen el uso que usted haga de los servicios personalizados de Healthy Mind, para la ayuda psicol??gica. El uso de nuestros servicios implica que usted los haya le??do y aceptado en el presente documento. El uso del servicio de Healthy Mind podr?? estar sujeto a t??rminos y condiciones adicionales que establezca, los cuales se incorporan a los presentes t??rminos mediante la presente referencia.Al adquirir el servicio de Healthy Mind, o al utilizarlo de cualquier otro modo, usted acepta los presentes T??rminos. Si no acepta, no podr?? acceder a ning??n contenido.La compra que se lleve a cabo por medio de este sitio web, est??n sujetas a un proceso de confirmaci??n y verificaci??n, el cual podr??a incluir verificaci??n de las existencias y disponibilidad del servicio, validaci??n de la forma de pago, validaci??n de la factura y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado. En algunos casos puede que se requiera una verificaci??n por medio de correo electr??nico.</p>
                                    <br><h1>Cuenta</h1><br>
                                    <p>Cuando se registre con nosotros, deber?? proporcionarnos informaci??n exacta, completa y actual en todo momento. En caso contrario estar??a violando estos t??rminos, lo que podr??a conducir al cierre inmediato de su cuenta en nuestro Servicio.Usted es el responsable de salvaguardar su contrase??a de acceso al Servicio y a cualquiera de las actividades o acciones que lo requieran, independientemente de que la contrase??a corresponda a nuestro servicio o a un servicio proporcionado por terceros.Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros servicios, modificando o sin modificar su contenido. Todos los servicios son propiedad de los proveedores del contenido. En caso de que no se especifique lo contrario, nuestros productos o servicios se proporcionan sin ning??n tipo de garant??a, expresa o impl??cita. En ning??n caso esta compa????a ser?? responsable de ning??n da??o incluyendo, pero no limitado a, da??os directos, indirectos y especiales u otras p??rdidas resultantes del uso o de la imposibilidad de utilizar nuestro servicio.A trav??s de estos t??rminos, usted se responsabiliza a no revelar su contrase??a a terceros. Si se produce cualquier violaci??n de la seguridad del sitio o un uso no autorizado de su cuenta, deber?? informarnos de inmediato.Est?? prohibida la utilizaci??n de un nombre de usuario que contenga el nombre de otra persona u entidad no disponible legalmente; el uso de un nombre o marca registrada que est?? sujeta a unos derechos sobre los que el usuario no tenga autorizaci??n; o la utilizaci??n de nombres ofensivos, vulgares u obscenos. El equipo de Healthy Mind se reserva el derecho a editar cualquier par??metro de su cuenta para adecuarlo a las buenas pr??cticas.</p>
                                    <br><h1>Cierre</h1><br>
                                    <p>Existe la posibilidad de que tomemos la decisi??n de cerrar o suspender su cuenta de manera inmediata y por cualquier raz??n (entre ellas, por violar de estos t??rminos), sin necesidad de notificaci??n previa y sin asumir responsabilidades de ning??n tipo.Tras el cierre, se suspender?? de manera inmediata su derecho a acceder al servicio. Si desea cerrar su cuenta, simplemente puede dejar de utilizar el servicio.</p>                               
                                    <br><h1>Licencia</h1><br>
                                    <p>Centro Integral de Psicolog??a a trav??s de su sitio web concede una licencia para que los usuarios utilicen los servicios que son ofrecidos en este sitio web de acuerdo a los T??rminos y Condiciones que se describen en este documento.</p>
                                    <br><h1>Pol??tica de reembolso y garant??a</h1><br>
                                    <p>No realizamos reembolsos despu??s de que se realiz?? el pago, usted tiene la responsabilidad de entender antes de comprarlo.Le pedimos que lea cuidadosamente antes de comprar el servicio. En tales casos la garant??a s??lo cubrir?? fallas de f??brica y s??lo se har?? efectiva cuando el producto se haya usado correctamente. La garant??a no cubre aver??as o da??os ocasionados por uso indebido. Los t??rminos de la garant??a est??n asociados a fallas de fabricaci??n y funcionamiento en condiciones normales de los productos y s??lo se har??n efectivos estos t??rminos si el equipo ha sido usado correctamente. Esto incluye:</p>
                                    <br>
                                    <ul>
                                        <li class="sangria">De acuerdo a las especificaciones t??cnicas indicadas para el servicio.</li>
                                        <li class="sangria">En uso espec??fico para la funci??n con que fue dise??ado de f??brica.</li>
                                        <li class="sangria">En condiciones de operaci??n el??ctrica acorde con las especificaciones y tolerancias indicadas.</li><br>
                                    </ul>
                                    
                                    <p>En el caso de pago por servicios al realizar el pago usted acepta las siguientes condiciones</p><br>
                                    <p>Para que su cancelaci??n sea efectiva y pueda reembolsar su dinero debe realizarse con al menos 24 horas antes de su cita. No existir??n reembolsos por cancelaciones realizadas durante las 24 horas antes de sus citas. Se permitir?? un (1) cambio de d??a y/o hora en caso de necesitar siempre y cuando se realice con 24 horas antes de su cita. Toda cuota deber?? ser cubierta antes de su cita para recibir la atenci??n. Este tipo de pol??ticas de cancelaci??n es est??ndar en los campos m??dicos y de la salud y ser?? aplicado estrictamente sin importar la raz??n.</p>
                                    <br><h1>Privacidad</h1><br>
                                    <p>Este sitio garantiza que la informaci??n personal que usted env??a cuenta con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una validaci??n del servicio no ser??n entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales.</p><br>
                                    <p>La suscripci??n a boletines de correos electr??nicos publicitarios es voluntaria y podr??a ser seleccionada al momento de crear su cuenta. </p><br>
                                    <h1>Condiciones para profesionales</h1><br>
                                    <h2>Modificaciones de precios</h2><br>
                                    <p>HEALTHY MIND puede, seg??n su criterio y en cualquier momento, modificar las cuotas de Suscripci??n. Cualquier cambio de las cuotas de suscripci??n entrar?? en vigor al final del Ciclo de facturaci??n actual.</p><br>
                                    <p>Le notificar?? con la suficiente antelaci??n de cualquier modificaci??n en las cuotas de suscripci??n para darle la oportunidad de finalizar antes de que dichas modificaciones se hagan efectivas.</p><br>
                                    <p>Un uso continuado del Servicio tras la entrada en vigor de la cuota de Suscripci??n modificada supone una aceptaci??n impl??cita del abono de dicha cantidad.</p><br>
                                    <h1>Tratamiento de datos y corresponsabilidad de Privacidad</h1><br>  
                                    <p>HEALTHY MIND responde al tratamiento de datos personales con la figura de corresponsables del tratamiento, teniendo ambas organizaciones responsabilidades en virtud del tipo de tratamiento de datos de car??cter personal que estas realizan.</p><br>
                                    <h1>Opciones del Servicio</h1><br>  
                                    <p>Algunas opciones del servicio de Healthy Mind, ofrecen de forma gratuita, mientras que otras opciones requieren un pago para poder acceder a las mismas. Tambi??n podemos ofrecer planes promocionales especiales, incluyendo ofertas de servicios de terceros. No somos responsables de los productos y servicios proporcionados por dichos terceros.</p><br>
                                    <h1>Forma de pago</h1><br>  
                                    <p>Las formas de pago ser??n estipulados por el psic??logo, de esta manera el paciente tendr?? la libertad de elegir al profesional que mejor se adapte y dentro de su capacidad financiera.A continuaci??n se detallan las formas de pago, con sus explicaciones:</p><br>
                                    <p>Mensual (Pago recurrente): En este modo, la plataforma cobrar?? mensualmente el pago  AUTOM??TICAMENTE, en el d??a y en m??todo solicitado (Tarjeta de cr??dito).</p>

			</div>
		</div>
    </main>
    <script src="../js/script.js"></script>
    <script src="../js/registro.js"></script>
    <script>
    var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
	overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');

btnAbrirPopup.addEventListener('click', function(){
	overlay.classList.add('active');
	popup.classList.add('active');
});

btnCerrarPopup.addEventListener('click', function(e){
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>