<?php
include_once("connection.php");
include_once("class/class_Incidencia.php");

$Incidencia = new Incidencia($_POST["titol_incidencia_parc"], $_POST["descripcio_incidencia_parc"], $_POST["prioritat_incidencia_parc"], $_POST["data_inici_incidencia_parc"], $_POST["data_fi_incidencia_parc"], $_POST["id_estat"], $_POST["id_usuari_client"], $_POST["id_usuari_empleat"]);

  $Incidencia->inserir_incidencia();

?>
