<!DOCTYPE html>
<html lang="ru">
<head>
    <!--Устанавливаем кодировку сайта-->
    <meta charset="UTF-8">
    
    <!--Устанавливаем заголовок окна-->
    <title><?= $title ?></title>
    
    <!--Устанавливаем иконку сайта для закладки в браузере-->
    <link rel="shortcut icon" href="<?= $favicon ?>">
    
    <!--Подключаем стили-->
    <?php foreach ($view->css as $css_file): ?>
    <link rel="stylesheet" href="<?= $css_file ?>" type="text/css"/>   
    <?php endforeach; ?>
        
    <!--Подключаем JS-скрипты из внешних файлов-->
    <?php foreach ($view->js as $js_file): ?>
    <script src="<?= $js_file ?>"></script>
    <?php endforeach; ?>
    
    <!--Вставляем JS-скрипты, сгенерированные программой-->
    <?php foreach ($view->js_snippets as $js_snippet): ?>
    <script><?= $js_snippet ?></script>
    <?php endforeach; ?>
</head>
<body>
    <div class="container">
        <!--Выводим заголовок-->
        <div class="header">
            <?= $header ?>
        </div>
        <!--Выводим контент-->
        <div class="content">
            <?= $content ?>
        </div>
        <!--Выводим подвал-->
        <div class="footer">
            <?= $footer ?>
        </div>
    </div>
</body>
</html>

