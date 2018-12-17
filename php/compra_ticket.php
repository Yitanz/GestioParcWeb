<?php
session_start();
include_once("/php/class/cart.php");
$cart = new Cart;
include_once("connection.php");
$connection = crearConnexio();
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
  if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
      $productID = $_REQUEST['id'];
      // get product details
      $query = $connection->query("SELECT * FROM products WHERE id = ".$productID);
      $row = $query->fetch_assoc();
      $itemData = array(
          'id' => $row['id'],
          'name' => $row['name'],
          'price' => $row['price'],
          'qty' => 1
      );
      $insertItem = $cart->insert($itemData);
      $redirectLoc = $insertItem?'viewCart.php':'index.php';
      header("Location: ".$redirectLoc);
 ?>
