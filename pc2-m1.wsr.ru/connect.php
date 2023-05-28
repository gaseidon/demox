<?php
	$connect = new mysqli("localhost", "root", "", "db_demo_2023");
	$connect->set_charset("utf8");

	if($connect->connect_error)
		die("Ошибка подключения: ". $connect->connect_error);
