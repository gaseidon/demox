<?php
	session_start();
	include "connect.php";
	$sql = "SELECT * FROM `products` WHERE `count_products` > 0 ORDER BY `created_at` DESC LIMIT 5";
	if(!$result = $connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);
	$data = "";
	while($row = $result->fetch_assoc())
		$data .= sprintf('
			<div class="slide">
				<img src="%s" alt="" />
				<h3><a href="product.php?id=%s">%s</a></h3>
			</div>
		', $row["path"], $row["product_id"], $row["name"]);
	if($data == "")
		$data = '<h3 class="text-center">Товары отсутствуют</h3>';
	
	include "header.php";
?>
	<main>
		<div class="content">
			
			<div class="head"><h2>Новинки компании</h2></div>

			<div id="slider">
				<div class="slides">
					<?= $data ?>
				</div>
			</div>
			<div class="head"><h2>О нас</h2></div>
			<div class="info_company">
				<div class="info_img">
				<a href="index.php" class="logo_src"><img src="logo/my_logo.png" alt=""></a>
				
			<h4 class='slogan'>Наш девиз: <br>Принтеры, которые хотят!</h4>
				</div>
<p class="info_text">Наша компания специализируется на предоставлении высококачественных принтеров как для личного, так и для профессионального использования. Мы предлагаем широкий спектр принтеров, которые предназначены для удовлетворения конкретных потребностей наших клиентов, независимо от того, требуется ли им простой домашний принтер или крупномасштабное решение для коммерческой печати. Наши принтеры известны своей надежностью, эффективностью и доступностью, и мы гордимся тем, что предлагаем исключительное обслуживание и поддержку клиентов. Помимо продажи принтеров, мы также предоставляем услуги по установке, обслуживанию и ремонту, гарантируя, что наши клиенты получат максимальную отдачу от своих инвестиций. Независимо от того, ищете ли вы простой струйный или мощный лазерный принтер, наша компания обладает знаниями и опытом, чтобы помочь вам найти идеальный принтер для ваших нужд.</p>
			</div>
			
		
			<div class="head" id="register" ><h2>Регистрация</h2></div>
			
			<form method="POST" id='form_reg' name="form" action="controllers/register.php">
				<input type="text" class='name' placeholder="Имя" name="name" data-reg="^[а-яА-Яё -]+$" pattern="^[а-яА-Яё -]+$" required>
				<input type="text" class='surname' placeholder="Фамилия" name="surname" data-reg="^[а-яА-Яё -]+$" pattern="^[а-яА-Яё -]+$" required>
				<input type="text" class='patronymic' placeholder="Отчество (не обязательно)"  name="patronymic"  data-reg="^[а-яА-Яё -]+$" pattern="^[а-яА-Яё -]+$">
				<input type="text" class='login' placeholder="Логин" name="login" data-log="уникальность логина" data-reg="^[a-zA-Z0-9 -]+$" pattern="^[a-zA-Z0-9 -]+$" required>
			
				<input type="text" class='email' placeholder="Email" name="email" data-reg="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" required>
				<input type="password" class='password'  placeholder="Пароль" name="password" data-reg=".{6,}" pattern=".{6,}" minlength="6" data-pas='пароль' required>
				<input type="password" class='password_repeat' placeholder="Повтор пароля"   name="password_repeat" data-pas='повтор пароля' required>
				<div class="part">
				<input type="checkbox" class="rules"  name="rules" data-reg="" required>
					<p>Согласие с правилами регистрации</p>
				</div>
				<button class="button" type="submit" name="button">Зарегистрироваться</button>
			</form>
		
			
			<div class="head" id="login"><h2>Вход</h2></div>
			<form id='form_log' action="controllers/login.php" method="POST">
				<input type="text" placeholder="Логин" name="login_signup" class="login_signup" >
				<input type="password" placeholder="Пароль" name="password_signup" class="password_signup" >
				<button class="btn" data-ver='0'>Войти</button>
			</form>
		
			</div>
		</div>
		
	</main>

	<script src="scripts/user.js"></script>
	<script src="scripts/valid.js"></script>
	<script src="scripts/slider.js"></script>
	<script src="scripts/valid_log_pas.js"></script>
<?php include "footer.php" ?>