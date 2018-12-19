<?php
/*Tanquem la sessió i redirigim a la pàgina principal*/
  session_start();
  session_unset();
  session_destroy();
  header('Location: index.php');
 ?>
