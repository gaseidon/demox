<?php
	include "check.php";
	include "../connect.php";
	$id = $_POST["id"];
	$sql = "SELECT * FROM `products` WHERE `product_id`=".$id;
	$product = $connect->query($sql)->fetch_assoc();
	
	
	$sql = sprintf("SELECT * FROM `orders` WHERE `user_id`='%s' AND `product_id`='%s'",$_SESSION["user_id"], $id);
	if($order = $connect->query($sql)->fetch_assoc())
		$connect->query(sprintf("UPDATE `orders` SET `count_orders`='%s' WHERE `order_id`='%s'", ++$order["count_orders"], $order["order_id"]));
	else
		$connect->query(sprintf("INSERT INTO `orders`(`product_id`, `user_id`, `count_orders`) VALUES('%s', '%s', '%s')", $product["product_id"], $_SESSION["user_id"], 1));

	$connect->query(sprintf("UPDATE `products` SET `count_products`='%s' WHERE `product_id`='%s'", --$product["count_products"], $product["product_id"]));
	echo $order['count_orders'];
