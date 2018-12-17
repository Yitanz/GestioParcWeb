<?php
session_start();
include_once("connection.php");
include_once("class/class_ticket.php");

$ticket = new Ticket($_POST['adult'],$_POST['xiquet'],$_POST['nado'],$_POST['visita']);

//$ticket->crear_ticket();
//$_SESSION['ticket'] .= $ticket;
//$_SESSION['var_dump($_SESSION);
var_dump($_SESSION);

array_push($_SESSION, $ticket);
var_dump($_SESSION);

 ?>
