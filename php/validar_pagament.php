<?php
include_once("connection.php");
//session_start();
include_once("class/cart.php");
$cart = new Cart;
//if($cart->total_items() > 0){
	foreach($cartItems as $item){

  var_dump($item['name']);
    var_dump($_SESSION['id_usuari']);
    $activitat=1;
    $connection = crearConnexio();
//	if ($item["name"].contains ("Entrada")){
    $sql="INSERT INTO venta_ticket (id_tipus_ticket, id_usauri, actiu) VALUES (?,?,?);";
    $resultat = $connection->prepare($sql);

    if($resultat == false){
      var_dump($resultat);
    }
    $resultat2 = $resultat->bind_param('sii', $item['name'], $_SESSION['id_usuari'],$activitat);

    if($resultat2 == false){
      var_dump($resultat);
    }

    $execua = $resultat->execute();
    if($execua == false){
      var_dump($resultat);
    }
//	}
}
