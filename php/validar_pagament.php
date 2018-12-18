<?php
include_once("connection.php");
//session_start();
include_once("class/cart.php");
$connection = crearConnexio();
$cart = new Cart;
$cartItems = $cart->contents();
//var_dump($_SESSION);
//





$sql_venta = "INSERT INTO VENTA_PRODUCTS (id_usuari, actiu) VALUES (?,?);";
$sentencia_venta = $connection->prepare($sql_venta);
if($sentencia_venta == false){
	die("Secured1");
}
$id_usuari = $_SESSION['id_usuari'];
$actiu = 1;
$sentencia_venta->bind_param("ii", $id_usuari, $actiu);
if($sentencia_venta == false){
	die("Secured");
}
$result = $sentencia_venta->execute();
$ultim_id = $connection->insert_id;
if($result==false){
	die("Secured");
}


/*

$query = $connection->query("SELECT * FROM VENTA_PRODUCTS");
		while ($row = $query->fetch_assoc()) {
			$test1 = $row['id_venta_ticket'];

		}
		var_dump($test1);
		*/
foreach($cartItems as $item){
	$id_producte=$item["id"];
	$nom=$item["name"];
	$preu=$item["price"];
	$cuantitat=$item["qty"];
	$total_preu=$item["subtotal"];

$sql = "INSERT INTO LINIA_VENTA (id_venta, product, quanititat	) VALUES (?,?,?);";

$sentencia = $connection->prepare($sql);
if($sentencia == false){
	die("Secured");
}
$sentencia->bind_param("iii", $ultim_id,$id_producte,$cuantitat);
if($sentencia == false){
	die("Secured");
}
$resultat2 = $sentencia->execute();
if($resultat2 == false){
	die("Secured");
}
}
//var_dump($id_producte);


?>
