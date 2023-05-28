<?php
	session_start();
	include "connect.php";
	$sql = "SELECT * FROM `categories`";
	$result = $connect->query($sql);
	$categories = "";
	while($row = $result->fetch_assoc())
		$categories .= sprintf('<option class="filter_category" value="%s">%s</option>', $row["category"], $row["category"]);
		$sql = "SELECT * FROM `products` WHERE `count_products` > 0 ORDER BY `created_at`";
	if(!$result=$connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);
	$data = "";
	while($row = $result->fetch_assoc())
		$data .= sprintf('
			<div class="col prod" data-prod="%s" data-val="%s">
					<img src="%s" alt="">
					
					<h3><a href="product.php?id=%s">%s</a></h3>
					<p>%s$</p>
					<input type="hidden" name="product_id"">
					<input type="hidden" value="%s" name="year">
					<input type="hidden" class="el_filter" value="%s" name="category">
					
				
			</div>
		',   $row["count_products"], $row["product_id"],$row["path"], $row["product_id"], $row["name"], $row["price"], $row["year"], $row["category"]);
		if($data == "")
		$data = '<h3 class="text-center">Товары отсутствуют</h3>';
	include "header.php";
?>

	<main>
		<div class="content">

			<div class="head"><h2>Наши товары</h2></div>
			<div class="row">
				<p>
					<span class="sp">Все</span> | 
					<span class="sp">Год</span> | 
					<span class="sp">Наименование</span> | 
					<span class="sp">Цена</span>
				</p>
				<select id="category">
					<option value disabled selected>Фильтрация по категориям ㅤㅤㅤㅤ▼</option>
					<option class="filter_category" value="Все">Все</option>
					<?= $categories ?>
				</select>
			</div>
			<div class="alim" id="products">
				<?= $data ?>
			</div>

		</div>
	</main>
	<script src='scripts/sort.js'></script>
	<script src='scripts/filter.js'></script>
	
	<script src='scripts/user.js'></script>
	
<?php include "footer.php" ?>