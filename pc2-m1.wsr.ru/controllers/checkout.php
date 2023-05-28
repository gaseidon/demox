<?php
	include "check.php";
	include "../connect.php";
	$data=$_POST["password"];
	$sql = sprintf("SELECT * FROM `users` WHERE `user_id`='%s'", $_SESSION["user_id"]);
	if($connect->query($sql)->fetch_assoc()["password"] != md5($data))
		echo "Ошибка пароля";
	else{
	$sql = sprintf("SELECT SUM(`count_orders`) FROM `orders` WHERE `user_id`='%s' AND `number` IS NULL", $_SESSION["user_id"]);
	$count = $connect->query($sql)->fetch_array()[0];

	$connect->query(sprintf("INSERT INTO `orders`(`product_id`, `user_id`, `number`, `count_orders`, `status`) VALUES('0', '%s', '%s', '%s', 'Новый')", $_SESSION["user_id"], rand(1000000000, 2000000000), $count));

	$connect->query(sprintf("DELETE FROM `orders` WHERE `user_id`='%s' AND `number` IS NULL", $_SESSION["user_id"]));
	echo "Заказ оформлен";
}