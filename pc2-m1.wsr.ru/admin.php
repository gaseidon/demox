<?php
session_start();
	include "connect.php";
	include "controllers/check_admin.php";


	$sql = "SELECT * FROM `categories`";
	$result = $connect->query($sql);
	$categories = "";
	while($row = $result->fetch_assoc())
		$categories .= sprintf('<option value="%s">%s</option>', $row["category"], $row["category"]);

	$sql = "SELECT * FROM `orders` INNER JOIN `users` USING(`user_id`) WHERE `status`>'' ORDER BY `created_at` DESC";
	$result = $connect->query($sql);
	$orders = "";
	while($row = $result->fetch_assoc()) {
		$adv = ($row["status"] == "Новый") ? '
			<form action="controllers/confirm_order.php" class="w100" method="POST">
				<input type="hidden" value="'.$row["order_id"].'" name="id" />
				<button>Подтвердить заказ</button>
			</form>
			<h3 class="text-center">Отменить заказ</h3>
			<form action="controllers/cancel_order.php" class="w100" method="POST">
				<input type="hidden" value="'.$row["order_id"].'" name="id" />
				<textarea placeholder="Причина отмены" name="reason" required></textarea>
				<button style="margin:0">Отменить заказ</button>
			</form>
		' : '';
		$adv = ($row["status"] == "Отменённый") ? '
			<h3 class="text-center">Причина отмены:</h3>
			<p class="reason">'.$row["reason"].'</p>
		' : $adv;
		$orders .= sprintf('
			<div class="col text-left main_ord">
				<h2>Заказ %s</h2>
				<p>Заказчик: <b>%s %s %s</b></p>
				<p>Статус заказа: <b class="stat">%s</b></p>
				<p>Количество товаров: <b>%s</b></p>
				<input type="hidden" value="%s" name="order_id" />
				%s
				<p class="text-small text-right">%s</p>
			</div>
		', $row["number"], $row["name"], $row["surname"], $row["patronymic"], $row["status"], $row["count_orders"], $row["order_id"], $adv, $row["created_at"]);
	}
	if(!$orders)
		$orders = '<h3 class="text-center">Заказы отсутствуют</h3>';

	include "header.php";
?>

	<main>
		<div class="content">
			

			<div class="head"><h2>Добавить товар</h2></div>
			<form enctype="multipart/form-data" action="controllers/add_product.php" method="POST">
				<input type="text" placeholder="Название" name="name" required>
				<input type="number" placeholder="Цена" name="price" required>
				<input type="text" placeholder="Страна производитель" name="country" required>
				<input type="number" placeholder="Год выпуска" name="year" required>
				<input type="text" placeholder="Модель" name="model" required>
				<select name="category" required>
					<option value selected disabled>Категория ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ ㅤㅤㅤㅤ ㅤㅤㅤㅤ ㅤㅤㅤㅤ ㅤㅤㅤㅤㅤ▼</option>
					<?= $categories ?>
				</select>
				<input type="number" placeholder="Количество на складе" name="count_products" required>
				<p class="text-left">Фотография товара</p>
				<input type="file" name="image" required>
				<button>Добавить</button>
			</form>
			<div class="head"><h2>Категории</h2></div>
			<form action="controllers/category_add.php" method="POST">
				<div class="part">
					<input type="text" placeholder="Название категории" name="category" required>
					<button class="small_button">Добавить</button>
				</div>
			</form>
			<form action="controllers/category_delete.php" method="POST">
				<div class="part">
					<select name="category" required>
					
						<option value selected disabled>Категории</option>
						<?= $categories ?>
					</select>
					<button class="small_button">Удалить</button>
				</div>
			</form>
			<div class="head"><h2>Заказы</h2></div>
			<select id="ord">
					<option value disabled selected>Фильтрация по заказам</option>
					<option class="filter_ord" value="Все">Все</option>
					<option class="filter_ord" value="Новый">Новый</option>
					<option class="filter_ord" value="Подтверждённый">Подтверждённый</option>
					<option class="filter_ord" value="Отменённый">Отменённый</option>
				</select>
			<div class="alim at" id="orders">
				<?= $orders ?>
			</div>
		</div>
	</main>
	<script src='scripts/filter_admin.js'></script>

<?php include "footer.php" ?>