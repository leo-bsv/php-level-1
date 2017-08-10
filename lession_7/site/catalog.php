<?php
    require_once 'config.php';
    require_once INCLUDES_DIR . 'session.php';   
    require_once INCLUDES_DIR . 'users_proc.php';   
    require_once INCLUDES_DIR . 'db_proc.php';     
    require_once INCLUDES_DIR . 'utils.php';
    require_once INCLUDES_DIR . 'render.php';
    
    $h1 = 'Стальные двери';
    $title = 'Каталог';
    $year = date("Y");   
    
    $alert = ''; 
    $link = connectToDB($alert);
    
    $user = getUserById($link, getUserIdFromSession());    
        
    $id = getReqAsInt('id'); 
    $products = getProducts($link);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Интернет-магазин стальных дверей</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	<div class="container">

                <?= render('header') ?>

		<div class="content">
			<h2>Каталог</h2>
			<div class="goods">
                            <?php foreach ($products as $product): ?>
				<div class="item">
					<h3><?= $product['name'] ?></h3>
					<img src="<?= $product['filename'] ?>" alt="<?= $product['name'] ?>">
					<div><a href="product.php?id=<?= $product['id'] ?>">подробнее...</a></div>
				</div>
                            <?php endforeach; ?>	
			</div>			
			<div class="clearfix"></div>
			<h2>Прайс</h2>
			<table>
				<tr>
					<th>№№</th>
					<th>Наименование</th>
					<th>Размер</th>
					<th>Опции</th>
					<th>Цена</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Дверной блок М1</td>
					<td>2050х880</td>
					<td>Глазок</td>
					<td>10100</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Дверной блок М2</td>
					<td>2050х880</td>
					<td>Глазок</td>
					<td>12300</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Дверной блок П1</td>
					<td>2050х880</td>
					<td>Глазок</td>
					<td>10500</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Дверной блок П2</td>
					<td>2050х880</td>
					<td>Глазок</td>
					<td>13800</td>
				</tr>
			</table>
			<div class="clearfix"></div>		
		</div>

		<div class="footer">
			<p class="center">Burkov&reg; Все права защищены<p>
			<p class="center">
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
				    <img style="border:0;width:88px;height:31px"
				        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
				        alt="Valid CSS!" />
				</a>
		    </p>		
		</div>
	
	</div>

</body>

</html>

