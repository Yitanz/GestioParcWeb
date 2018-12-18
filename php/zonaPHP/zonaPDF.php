<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/class/class_zona.php";
if (isset($_POST['Exportar'])) {
  Zona::llistatZonaPDF();
}
?>
