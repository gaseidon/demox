<?php
	include "check.php";
	include "../connect.php";
	$id = $_POST["id"];
	$sql = sprintf("SELECT `order_id`, `product_id`, `number`, `count_orders`, `name`, `count_products` FROM `orders` INNER JOIN `products` USING(`product_id`) WHERE `user_id`='%s' AND `product_id`='%s'", $_SESSION["user_id"], $id);
	$order = $connect->query($sql)->fetch_assoc();
	if($order["count_orders"] > 1)
		$connect->query(sprintf("UPDATE `orders` SET `count_orders`='%s' WHERE `order_id`='%s'", --$order["count_orders"], $order["order_id"]));
	else{
		$connect->query(sprintf("UPDATE `orders` SET `count_orders`='%s' WHERE `order_id`='%s'", --$order["count_orders"], $order["order_id"]));
		$connect->query(sprintf("DELETE FROM `orders` WHERE `user_id`='%s' AND `product_id`='%s'", $_SESSION["user_id"], $order["product_id"]));
		
	}
	$connect->query(sprintf("UPDATE `products` SET `count_products`='%s' WHERE `product_id`='%s'", ++$order["count_products"], $order["product_id"]));
	echo $order['count_orders'];
