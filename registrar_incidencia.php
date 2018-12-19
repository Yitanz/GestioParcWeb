<?php
include_once("connection.php");
include_once("class/class_Incidencia.php");

/*Agafem les dades de la incidència i la registrem en la base de dades*/
$Incidencia = new Incidencia($_POST["titol_incidencia_parc"], $_POST["descripcio_incidencia_parc"], $_POST["prioritat_incidencia_parc"], $_POST["data_inici_incidencia_parc"], $_POST["data_fi_incidencia_parc"]);

  $Incidencia->inserir_incidencia();
  $Incidencia->validar_incidencia();

?>
