<?php
include "../connect.php";

$_ERROR_VALID = array();

$name=trim($_POST['name']);
$surname=trim($_POST['surname']);
$patronymic=trim($_POST['patronymic']);
$login=$_POST['login'];
$email=$_POST['email'];
$password=md5($_POST['password']);
if (!preg_match('/^[а-яА-Яё -]+$/u', $name)) $_ERROR_VALID[] = 'name';
if (!preg_match('/^[а-яА-Яё -]+$/u', $surname)) $_ERROR_VALID[] = 'surname';
if (!preg_match('/^[a-zA-Z0-9 -]+$/u', $login)) $_ERROR_VALID[] = 'login';
if (!preg_match('/.{6,}/u', $password)) $_ERROR_VALID[] = 'password';
if (!preg_match('/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/u', $email)) $_ERROR_VALID[] = 'email';


function checkUserExists($connect,$login){
	$stmt = $connect->prepare("SELECT * FROM `users` WHERE `login`=?");
	$stmt->bind_param("s", $login);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_assoc();
    return $result;
}
function regUser($connect,$name,$surname,$patronymic,$login,$email,$password,$role){
	$stmt = $connect->prepare("INSERT INTO `users` VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssss", $name,$surname,$patronymic,$login,$email,$password,$role);
	$stmt->execute();
	return header("Location:../index.php?message=Вы зарегистрировались");
}
$errors = [];
$user = checkUserExists($connect, $_POST['login']);
if ($user) {
    if ($user['login'] == $_POST['login']) {
        $errors[] = "логин занят";
} 
}
if (!$errors && !$_ERROR_VALID) {
    regUser($connect,$name, $surname, $patronymic, $login, $email, $password, 'client');
}
else{
	echo 'Регистрация не удалась';
}