<?php
require '../connect.php';
$sql = "SELECT * FROM `categories` WHERE `category` = ?";
$stmt = $connect ->prepare($sql);
$stmt->bind_param("s", $_POST['filter']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo $_POST['filter'];
}
