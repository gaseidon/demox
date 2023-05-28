<?php
	session_start();
	include "connect.php";
	$role = (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest";
	$id = (isset($_GET["id"])) ? $_GET["id"] : 0;
	$sql = "SELECT * FROM `products` WHERE `count_products` > 0 AND `product_id`=". $id;
	if(!$result = $connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);

	if(!$product = $result->fetch_assoc())
		return header("Location:index.php?message=Товар отсутствует");
	include "header.php";
?>
	<main>
		<div class="content">
			<div class="head"><h2><?= $product["name"] ?></h2></div>
			<div class="product wrap">
				<div class="image">
					<img src="<?= $product["path"] ?>" alt="">
				</div>
				<div class="text">
					<h3>Характеристики:</h3>
					<p>Страна: <b><?= $product["country"] ?></b></p>
					<p>Год выпуска: <b><?= $product["year"] ?></b></p>
					<p>Модель: <b><?= $product["model"] ?></b></p>
					<hr>
					<div class="row">
						<p>Цена:</p>
						<h3><?= $product["price"] ?>$</h3>
					</div>
					<input type="hidden" value="<?= $product["product_id"] ?>" name="product_id">
					<div class="prod" data-prod="<?= $product["count_products"] ?>" data-val="<?= $product["product_id"] ?>">
				</div>
			</div>
		</div>
	</main>
	<script src='scripts/user.js'></script>
<?php include "footer.php" ?>