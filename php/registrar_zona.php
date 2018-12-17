<?php
  include_once ("class/class_zona.php");

  $zona = new Zona($_POST["nom"]);

  $zona->inserir_zona();
?>
