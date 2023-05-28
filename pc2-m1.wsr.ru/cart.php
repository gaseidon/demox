<?php
	include "controllers/check.php";

	include "connect.php";

	$sql = sprintf("SELECT `order_id`, `product_id`, `count_products`, `count_orders`,`name`, `price`, `path` FROM `orders` INNER JOIN `products` USING(`product_id`) WHERE `user_id`='%s'", $_SESSION["user_id"]);
	$result = $connect->query($sql);
	
	$products = "";
	while($row = $result->fetch_assoc()){
		$products .= sprintf('
			<div class="col cart">
				<img src="%s" alt="">
				<div class="row">
					<h3><a href="product.php?id=%s">%s</a></h3>
					<p>%s$</p>
				</div>
				<div class="row">
					<p class="minus" data-id="%s">-</p>
					<p id="c1">%s</p>
					<p class="plus" data-prod="%s" data-id="%s">+</p>
					<div class="error_product">Выбрано макс. количество товара</div>
				</div>
			</div>
		', $row["path"], $row["product_id"], $row["name"], $row["price"], $row["product_id"], (string)$row["count_orders"],$row["count_products"],$row["product_id"]);
		
	}
	if($products == "")
		$products = '<h3 class="text-center">Корзина пуста</h3>';

	$sql = sprintf("SELECT * FROM `orders` WHERE `user_id`='%s' AND `number` IS NOT NULL AND `product_id`=0 ORDER BY `created_at` DESC", $_SESSION["user_id"]);
	$result = $connect->query($sql);
	
	$orders = "";
	while($row = $result->fetch_assoc()) {
		$del = ($row["status"] == "Новый") ? '<p class="text-right"><a onclick="return confirm(\'Вы действительно хотите удалить этот заказ?\')" href="controllers/delete_order.php?id='.$row["order_id"].'" class="text-small">Удалить заказ</a></p>' : '';
		$orders .= sprintf('
			<div class="col">
				<div class="group">
					<h2>Заказ %s</h2>
					
				</div>
				<div class="row">
					<p>Статус: <b>%s</b></p>
					<p>Количество товаров: <b>%s</b></p>
					%s
				</div>
			</div>
		', $row["number"], $row["status"], $row["count_orders"], $del);
	}

	if($orders == "")
		$orders = '<h3 class="text-center">Список заказов пуст</h3>';
	include "header.php";
?>
	<main>
		<div class="content">
			<div class="head"><h2>Ваша корзина</h2></div>
			<div class="alim">
			<?= $products ?>
			</div>
			<br>
			<div class="wrap wrap_check">
				<form class="w100 form_checkout">
					<input type="password" placeholder="Ваш пароль" name="password" class="checkout_password" required>
					<button class="checkout">Заказать</button>
					<div class="error_password">Пароль неверный!</div>
				</form>
			</div>
			<div class="head"><h2>Ваши заказы</h2></div>
			<div class="alim">
			<?= $orders ?>
			</div>

		</div>
	</main>
	<script src='scripts/user.js'></script>
<?php include "footer.php" ?>
