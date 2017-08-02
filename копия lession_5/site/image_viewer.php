<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'db_proc.php';       

    $h1 = 'Стальные двери';
    $title = 'Просмотр картинки';
    $year = date("Y");
    
    $menu = [
        ['link' => 'index.php', 'caption' => 'Главная'],
        ['link' => 'galary.php', 'caption' => 'Галерея'],
        ['link' => 'catalog.html', 'caption' => 'Каталог'],
        ['link' => 'contacts.html', 'caption' => 'Контакты']
    ];
    
    $alert = '';    
    $link = connectToDB($alert);
    
    $id = mysqli_real_escape_string($link, $_REQUEST['id']);
    $views = incImageViews($link, $id);
    $img_path = getPathById($link, $id);
    
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
                        foreach ($menu as $item) {
                           echo '<li><a href="' . $item['link'] . '"><div class="marker"></div>' . $item['caption'] . '</a></li>';
                        }
                        ?>                            
                    </ul>
            </div>				

            <div class="content">
                <?php
                    echo <<<HTML
                        <div class="image">
                            <img src="$img_path" alt="picture"><br>
                        </div>
                        <p>Просмотров: $views</p>
HTML;
                ?>
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
    <script>
        var msg = '<?= $alert ?>';
        if (msg != '') alert(msg);
    </script>               
</body>

</html>

