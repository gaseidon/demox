<?php
include "../connect.php";
// print_r($_POST['dat']['method']);
$arr=array();
$sql = sprintf("SELECT * FROM `products` WHERE `count_products` > 0 ORDER BY `%s` %s",$_POST['dat']['type'],$_POST['dat']['method'] );
// print_r($sql);
$result=$connect->query($sql);

while($row = $result->fetch_assoc()){
    array_push($arr,json_encode($row));
}
print_r(json_encode($arr));

