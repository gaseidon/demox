<?php
	include "check_admin.php";
	include "../connect.php";

	$del=$_POST["category"];
	$connect->query("DELETE FROM `categories` WHERE `category`='$del'");
	$connect->query("DELETE FROM `products` WHERE `category`='$del'");
	return header("Location:../admin?message=Категория удалена");