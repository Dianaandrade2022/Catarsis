<?php
//para inicializar la sesion
session_start();
require_once 'conexion.php';
$database = new database();
$con = $database->conectar();
//verificamos que los datos se hallan enviado
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
//que cree las variables
    $email = $_POST['email'];
    $Contrasenia = $_POST['Contrasenia'];
//desencripte nuestra contraseña
    $Contrasenia = hash('sha512',$Contrasenia); 
//verificamos que el correo sea el mismo 
    $verificar_correo = $con->prepare("SELECT * FROM usuario WHERE correo = '$email'");
    $verificar_correo -> execute();
    //hacemos el conteo de el correo 
    $conteo_correo = $verificar_correo -> rowCount();

//verificamos que la contraseña sea la misma
    $verificar_pass = $con->prepare("SELECT * FROM usuario WHERE pass = '$Contrasenia'");
    $verificar_pass -> execute();
    $conteo_pass = $verificar_pass -> rowCount();
  //   $rol = $con -> prepare("SELECT tipo_persona FROM persona WHERE correo = '$email' ");
  
if ($conteo_correo>0) {
    if ($conteo_pass>0) {
             //Obtener el id del usuario 
             $id_usuario = $con-> prepare("SELECT id_usuario FROM usuario WHERE correo = '$email' limit 1");
             $id_usuario ->execute(); 
             $id_usuario = $id_usuario->fetch(PDO::FETCH_ASSOC);
            $id_usuario = $id_usuario['id_usuario'];
            //verificar que sea colaborador o paciente 
            $colaborador = $con->prepare("SELECT * FROM colaborador col INNER JOIN persona on col.id_persona = persona.id_persona INNER JOIN usuario on persona.id_usuario = usuario.id_usuario WHERE usuario.id_usuario = $id_usuario;");
            $colaborador ->execute();
            $colaborador = $colaborador->fetch(PDO::FETCH_ASSOC);
            if ($colaborador == '') {
                
            }else{
                $colaborador = $colaborador['admin'];
            }
            if ($colaborador==1) {
                $_SESSION['correocol'] = $email;
                echo'
                <script>
                alert("Bienvenido a HealthyMind colaborador");
                window.location = "../../indexcolaborador.php";
                </script>';
                 exit;
            }else{
        $_SESSION['correo'] = $email;
        $_SESSION['start'] = time();
        echo'
        <script>
        alert("Bienvenido a HealthyMind");
        window.location = "../../index2.php";
        </script>';
         exit;
        }
     }else{
        echo'
        <script>
        alert("Su contraseña es incorrecta");
        window.location = "../registro.php";
        </script>';
        exit;
       }
    }else{
    echo'
    <script>
    alert("Este usuario no existe");
    window.location = "../registro.php";
    </script>';
    exit;
    } 
}   
    ?>