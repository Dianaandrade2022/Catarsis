<?php

Class database {
  private $local = 'localhost';
  private $db = 'healthymind';
  private $password = '';
  private $root = 'root';
  private $charset = 'utf8';

function conectar(){
  try {
  $conexion = "mysql:host=" . $this ->local . "; dbname=" . $this->db . "; charset=" . $this->charset;
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
$pdo = new PDO($conexion, $this->root, $this->password, $options);
return $pdo;
}
   
  catch (PDOException $e) {
    exit;
  }
}
}
?>