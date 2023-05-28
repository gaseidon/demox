<?php
require '../connect.php';
$sql = "SELECT * FROM `users` WHERE `login` = ?";
$stmt = $connect ->prepare($sql);
$stmt->bind_param("s", $_POST['login']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo 'Логин занят';
}