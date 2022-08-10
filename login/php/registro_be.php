<?php
require 'conexion.php';
$database = new database();
$con = $database->conectar();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$usuario= $_POST['usuario'];
$email = $_POST['email'];
$Contrasenia = $_POST['Contrasenia'];
//verificamos que el correo y usuario no existan
$verificar_correo = $con->prepare("SELECT * FROM usuario WHERE correo = '$email'");
$verificar_correo ->execute();
$conteo_correo = $verificar_correo ->rowCount();

$verificar_usuario = $con->prepare("SELECT * FROM usuario WHERE usuario = '$usuario'");
$verificar_usuario ->execute();
$conteo_usuario = $verificar_usuario->rowCount();

if(($conteo_correo)>0){
    echo'
    <script>
    alert("este correo ya existe");
    window.location = "../registro.php";
    </script>';
    exit(); 
}elseif (($conteo_usuario)>0) {
    echo'
    <script>
    alert("este usuario ya existe");
    window.location = "../registro.php";
    </script>';
    exit(); 
} 

//encriptar contraseña
$Contrasenia = hash('sha512',$Contrasenia);
$consulta = $con->prepare("INSERT INTO usuario(usuario,correo,pass)
VALUES ('$usuario','$email','$Contrasenia')");
$consulta -> execute();
if($consulta){
    echo'
    <script>
    alert("Registrado correctamente ahora inicie sesión");
    window.location = "../registro.php";
    </script>';
    
}else {
    echo'
    <script>
    alert("Hubo un error intentelo de nuevo");
    window.location = "../registro.php";
    </script>';
}

}

?>