<?php
	include "check_admin.php";
	include "../connect.php";
	$path = "images/upload/1_". time() ."_". $_FILES["image"]["name"];
	$imageFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
	if($_FILES["image"]["size"] < 5242880 && ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")){
	move_uploaded_file($_FILES["image"]["tmp_name"], "../".$path);
	$connect->query(sprintf("INSERT INTO `products`(`name`, `price`, `country`, `year`, `model`, `category`, `count_products`, `path`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $_POST["name"], $_POST["price"], $_POST["country"], $_POST["year"], $_POST["model"], $_POST["category"], $_POST["count_products"], $path));
	return header("Location:../admin?message=Товар добавлен");
}
else{
	return header("Location:../admin?message=Неверный формат файла или размер больше 5 мб");
}