<?php
require '../connect.php';
$sql = "SELECT * FROM `orders` WHERE `status` = ?";
$stmt = $connect ->prepare($sql);
$stmt->bind_param("s", $_POST['dar']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo $_POST['dar'];
}
