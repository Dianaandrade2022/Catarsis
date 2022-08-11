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
                    <h3>¿Ya te has registrado?</h3>
                    <p>¿Qué esperas?. Inicia Sesión Ahora</p>
                    <button id="btn_Login">Iniciar Sesión</button>
                </div>
                <div class="caja_delanteraregistro">
                    <h3>¿No tienes una cuenta?</h3>
                    <P>Registrate ahora para obtener nuestros servicios</P>
                    <button id="btn_singup">Registrarse</button>
                </div>
            </div>

            <div class="loginregistro">

                <form action="php/iniciarsesion.php" class="form_login" method="POST">
                    <h2>Iniciar sesión</h2>
                    <input type="email" placeholder="Correo electronico" name="email" required>
                    <div class="group">
                    <input type="password" placeholder="Contraseña" name="Contrasenia" required>
                    </div>
                    <button>Iniciar sesión</button>
                </form>

                <form action="php/registro_be.php" method="POST" class="form_registrar">
                        <h2>Registrarse</h2>
                        <input type="text" placeholder="Usuario" name="usuario" required>
                        <input type="email" placeholder="Correo electronico" name="email" required>
                        <input type="password" placeholder="Contraseña" name="Contrasenia" required>
                        <p>Al registrarse acepta terminos y condiciones</p>
                        <a href="#" class="Terminos">
                        <p style = "font-size:13px; color:gray;"id="btn-abrir-popup" class="btn-abrir-popup">Leer más</p></a>  
                        <br>
                        <button>Registrar</button>
                        <p>¡La importancia de estar bien!</p>
                </form>
                
                </div>
            </div>
            <div class="overlay" id="overlay">
			<div class="popup justify-content-start" id="popup" style="overflow-y:scroll; height: 600px; -webkit-scrollbar-thumb:background-color:black;">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="material-icons">clear</i></a>
				<h1>Términos y servicios</h1><br>
                                    <p>Lea detenidamente los presentes Términos y Condiciones que rigen el uso que usted haga de los servicios personalizados de Healthy Mind, para la ayuda psicológica. El uso de nuestros servicios implica que usted los haya leído y aceptado en el presente documento. El uso del servicio de Healthy Mind podrá estar sujeto a términos y condiciones adicionales que establezca, los cuales se incorporan a los presentes términos mediante la presente referencia.Al adquirir el servicio de Healthy Mind, o al utilizarlo de cualquier otro modo, usted acepta los presentes Términos. Si no acepta, no podrá acceder a ningún contenido.La compra que se lleve a cabo por medio de este sitio web, están sujetas a un proceso de confirmación y verificación, el cual podría incluir verificación de las existencias y disponibilidad del servicio, validación de la forma de pago, validación de la factura y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado. En algunos casos puede que se requiera una verificación por medio de correo electrónico.</p>
                                    <br><h1>Cuenta</h1><br>
                                    <p>Cuando se registre con nosotros, deberá proporcionarnos información exacta, completa y actual en todo momento. En caso contrario estaría violando estos términos, lo que podría conducir al cierre inmediato de su cuenta en nuestro Servicio.Usted es el responsable de salvaguardar su contraseña de acceso al Servicio y a cualquiera de las actividades o acciones que lo requieran, independientemente de que la contraseña corresponda a nuestro servicio o a un servicio proporcionado por terceros.Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros servicios, modificando o sin modificar su contenido. Todos los servicios son propiedad de los proveedores del contenido. En caso de que no se especifique lo contrario, nuestros productos o servicios se proporcionan sin ningún tipo de garantía, expresa o implícita. En ningún caso esta compañía será responsable de ningún daño incluyendo, pero no limitado a, daños directos, indirectos y especiales u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestro servicio.A través de estos términos, usted se responsabiliza a no revelar su contraseña a terceros. Si se produce cualquier violación de la seguridad del sitio o un uso no autorizado de su cuenta, deberá informarnos de inmediato.Está prohibida la utilización de un nombre de usuario que contenga el nombre de otra persona u entidad no disponible legalmente; el uso de un nombre o marca registrada que esté sujeta a unos derechos sobre los que el usuario no tenga autorización; o la utilización de nombres ofensivos, vulgares u obscenos. El equipo de Healthy Mind se reserva el derecho a editar cualquier parámetro de su cuenta para adecuarlo a las buenas prácticas.</p>
                                    <br><h1>Cierre</h1><br>
                                    <p>Existe la posibilidad de que tomemos la decisión de cerrar o suspender su cuenta de manera inmediata y por cualquier razón (entre ellas, por violar de estos términos), sin necesidad de notificación previa y sin asumir responsabilidades de ningún tipo.Tras el cierre, se suspenderá de manera inmediata su derecho a acceder al servicio. Si desea cerrar su cuenta, simplemente puede dejar de utilizar el servicio.</p>                               
                                    <br><h1>Licencia</h1><br>
                                    <p>Centro Integral de Psicología a través de su sitio web concede una licencia para que los usuarios utilicen los servicios que son ofrecidos en este sitio web de acuerdo a los Términos y Condiciones que se describen en este documento.</p>
                                    <br><h1>Política de reembolso y garantía</h1><br>
                                    <p>No realizamos reembolsos después de que se realizó el pago, usted tiene la responsabilidad de entender antes de comprarlo.Le pedimos que lea cuidadosamente antes de comprar el servicio. En tales casos la garantía sólo cubrirá fallas de fábrica y sólo se hará efectiva cuando el producto se haya usado correctamente. La garantía no cubre averías o daños ocasionados por uso indebido. Los términos de la garantía están asociados a fallas de fabricación y funcionamiento en condiciones normales de los productos y sólo se harán efectivos estos términos si el equipo ha sido usado correctamente. Esto incluye:</p>
                                    <br>
                                    <ul>
                                        <li class="sangria">De acuerdo a las especificaciones técnicas indicadas para el servicio.</li>
                                        <li class="sangria">En uso específico para la función con que fue diseñado de fábrica.</li>
                                        <li class="sangria">En condiciones de operación eléctrica acorde con las especificaciones y tolerancias indicadas.</li><br>
                                    </ul>
                                    
                                    <p>En el caso de pago por servicios al realizar el pago usted acepta las siguientes condiciones</p><br>
                                    <p>Para que su cancelación sea efectiva y pueda reembolsar su dinero debe realizarse con al menos 24 horas antes de su cita. No existirán reembolsos por cancelaciones realizadas durante las 24 horas antes de sus citas. Se permitirá un (1) cambio de día y/o hora en caso de necesitar siempre y cuando se realice con 24 horas antes de su cita. Toda cuota deberá ser cubierta antes de su cita para recibir la atención. Este tipo de políticas de cancelación es estándar en los campos médicos y de la salud y será aplicado estrictamente sin importar la razón.</p>
                                    <br><h1>Privacidad</h1><br>
                                    <p>Este sitio garantiza que la información personal que usted envía cuenta con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una validación del servicio no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales.</p><br>
                                    <p>La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría ser seleccionada al momento de crear su cuenta. </p><br>
                                    <h1>Condiciones para profesionales</h1><br>
                                    <h2>Modificaciones de precios</h2><br>
                                    <p>HEALTHY MIND puede, según su criterio y en cualquier momento, modificar las cuotas de Suscripción. Cualquier cambio de las cuotas de suscripción entrará en vigor al final del Ciclo de facturación actual.</p><br>
                                    <p>Le notificará con la suficiente antelación de cualquier modificación en las cuotas de suscripción para darle la oportunidad de finalizar antes de que dichas modificaciones se hagan efectivas.</p><br>
                                    <p>Un uso continuado del Servicio tras la entrada en vigor de la cuota de Suscripción modificada supone una aceptación implícita del abono de dicha cantidad.</p><br>
                                    <h1>Tratamiento de datos y corresponsabilidad de Privacidad</h1><br>  
                                    <p>HEALTHY MIND responde al tratamiento de datos personales con la figura de corresponsables del tratamiento, teniendo ambas organizaciones responsabilidades en virtud del tipo de tratamiento de datos de carácter personal que estas realizan.</p><br>
                                    <h1>Opciones del Servicio</h1><br>  
                                    <p>Algunas opciones del servicio de Healthy Mind, ofrecen de forma gratuita, mientras que otras opciones requieren un pago para poder acceder a las mismas. También podemos ofrecer planes promocionales especiales, incluyendo ofertas de servicios de terceros. No somos responsables de los productos y servicios proporcionados por dichos terceros.</p><br>
                                    <h1>Forma de pago</h1><br>  
                                    <p>Las formas de pago serán estipulados por el psicólogo, de esta manera el paciente tendrá la libertad de elegir al profesional que mejor se adapte y dentro de su capacidad financiera.A continuación se detallan las formas de pago, con sus explicaciones:</p><br>
                                    <p>Mensual (Pago recurrente): En este modo, la plataforma cobrará mensualmente el pago  AUTOMÁTICAMENTE, en el día y en método solicitado (Tarjeta de crédito).</p>

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