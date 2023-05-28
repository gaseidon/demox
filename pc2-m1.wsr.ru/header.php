<?php
	$menu = '
		<li><a href="index.php">О нас</a></li>
		<li><a href="catalog.php">Каталог</a></li>
		<li><a href="where.php">Где нас найти?</a></li>
		%s
		<p class="role">'.$_SESSION["role"].'</p>
		'
	;

	$m = '';
	if(isset($_SESSION["role"])) {
		$m = '<li><a href="cart.php">Корзина</a></li>';
		$m .= ($_SESSION["role"] == "admin") ? '<li><a href="admin">Админ-панель</a></li>' : '';
		$m .= '<li><a href="controllers/logout.php">Выход</a></li>';
	} else
		$m = '
			<li><a href="index.php#login">Вход</a></li>
			<li><a href="index.php#register">Регистрация</a></li>
		';

	$menu = sprintf($menu, $m);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Интернет-магазин</title>
	<link rel="stylesheet" href="style.css">
	<script src="scripts/jq.js"></script>
	<script src="scripts/hide_message.js"></script>
	<script>
		let role = "<?= (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest" ?>";
		
	</script>
	
</head>
<body>

	<header>
		<div class="content">
			<div class="nav_elements">
		<div class="top">
			
		<a href="index.php" class="logo_src"><img src="logo/my_logo.png" alt=""></a>
			 	
			<h5 class="slogan">Принтеры, которые хотят!</h5>
			<input type="hidden" class="user_id" name="user_id" value="<?= $_SESSION["user_id"] ?>">
		
		</div>
	
			<ul>
				<?= $menu ?>
			</ul>
			</div>
		</div>
	</header>

	<div class="message"><?= (isset($_GET["message"])) ? $_GET["message"] : ""; ?></div>