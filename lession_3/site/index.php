<?php
    $h1 = 'Стальные двери';
    $title = 'Интернет-магазин стальных дверей';
    $year = date("Y");
    
    // Ответ на вопрос ДЗ № 6 (Уровень-1 Урок-3)
    $menu = [
        ['link' => 'index.php', 'caption' => 'Главная'],
        ['link' => 'catalog.html', 'caption' => 'Каталог'],
        ['link' => 'contacts.html', 'caption' => 'Контакты']
    ];
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="container">

		<div class="header">
			<div class="topik">
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
			</div>
			<div class="logo">BURKOV&reg; </div>
			<h1><?= $h1 ?></h1>
			<ul class="menu">
                            <?php
                            // Ответ на вопрос ДЗ № 6 (Уровень-1 Урок-3)
                            foreach ($menu as $item) {
                               echo '<li><a href="' . $item['link'] . '"><div class="marker"></div>' . $item['caption'] . '</a></li>';
                            }
                            ?>                            
<!--				<li><a href="index.php"><div class="marker"></div>Главная</a></li>
				<li><a href="catalog.html"><div class="marker"></div>Каталог</a></li>
				<li><a href="contacts.html"><div class="marker"></div>Контакты</a></li>-->
			</ul>
		</div>				

		<div class="content">
			<img class="abstraction" src="img/abs.jpg" alt="abstraction">
			<h2>Добрый день!</h2>
			<p>Рады приветствовать вас в&nbsp;нашем интернет-магазине!<br />
			Здесь вы&nbsp;сможете найти всю необходимую информацию по&nbsp;нашей<br />
			продукции, смежным товарам и&nbsp;услугам. Контактная информация<br />
			находится в&nbsp;соответствующем разделе, удачи!</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum nesciunt doloribus hic quod suscipit nam, odit soluta vitae ut, quae dolorum expedita eum voluptatibus. Odit, iure earum fugit? Nam, ab.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor officiis, amet atque beatae labore. Dolorem repellat repellendus totam ipsum, ea incidunt, natus quam vero, explicabo nostrum omnis dolor! Aliquid, vitae.</p>
			<div class="clearfix"></div>
		</div>

		<div class="footer">
			<p class="center">Burkov&reg; Все права защищены <?= $year ?><p>
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

