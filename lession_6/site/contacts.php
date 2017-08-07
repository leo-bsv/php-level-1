<?php
    require_once 'config.php';
    require_once INCLUDES_DIR . 'render.php';
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

		<div class="header">
			<div class="topik">
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
				<div class="topikCrumbs"></div>
			</div>
			<div class="logo">BURKOV&reg;</div>
			<h1>Стальные двери</h1>
                        <?= render('menu') ?>
		</div>	

		<div class="content">
			<h2>Адрес</h2>
			<p>123456, Россия, Москва, ул. Ленина, д. 12, 4 этаж, офис 1244</p>
			<h2>Телефон</h2>
			<p>(495) 325-23-34</p>
			<h2>E-mail</h2>
			<a href="mailto:imag@yandex.ru">imag@yandex.ru</a>
			<h2>Мы на карте</h2>
			<div class="mapflex">
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A69abb35315b3941344647f279dc295a09f22ca2f91647fdb8c70442d18b3d8f6&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
			</div>
			<hr>
			<h2>Напишите нам</h2>
			<form action="#">
				<div>
					<label class="label" for="visitor_name">Имя</label>
					<input class="field" type="text" id="visitor_name" placeholder="ваше имя...">
				</div>
				<div>
					<label class="label" for="visitor_mail">E-mail</label>
					<input class="field" type="email" id="visitor_mail" placeholder="ваш почтовый ящик...">
				</div>
				<div>
					<label class="label" for="subject">Тема</label>
					<input class="field" type="text" id="subject" placeholder="тема сообщения...">
				</div>
				<!-- <div class="message-label">Текст сообщения</div> -->
				<!-- <textarea id="msg_text" placeholder="текст сообщения..." cols="70" rows="10"></textarea> -->
				<div class="mapflex">
					<textarea class="message" id="msg_text" placeholder="текст сообщения..."></textarea>
				</div>
				<div class="buttons"><input type="reset" value="Очистить">&nbsp;<input type="submit" value="Отправить"></div>
			</form>
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

