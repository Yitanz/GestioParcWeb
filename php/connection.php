<?php

function crearConnexio(){
  $server = "localhost";
  $usuari = "root";
  $passwd = "alumne";
  $namedb = "univeylandia";

  $connection= new mysqli($server, $usuari, $passwd, $namedb);

  if($connection->connect_error){
    die("Error: ". $connection->connect_error);
  }
  //echo "Conexio correcta";
  return $connection;
}

?>
