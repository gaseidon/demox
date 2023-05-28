<?php
	include "../connect.php";
	session_start();
	function authUser($connect,$login,$password){
		$sql='SELECT * FROM `users` WHERE `login` = ?';
		$stmt = $connect ->prepare($sql);
		$stmt->bind_param("s", $login);
		$stmt->execute();
		$result = $stmt->get_result();
		if($user = $result->fetch_assoc()) {
			if($user["password"] == $password) {
				
			$_SESSION["user_id"] = $user["user_id"];
			$_SESSION["role"] = $user["role"];

			return header("Location:../cart.php");
		}
	}
	return header("Location:../index.php?message=Ошибка логина или пароля");
}
authUser($connect,$_POST['login_signup'],md5($_POST['password_signup']));