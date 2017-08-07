<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'db_proc.php';       
    require_once INCLUDES_DIR . 'render.php';    

    $h1 = 'Стальные двери';
    $title = 'Галерея изображений пользователей';
    $year = date("Y");
    
    $alert = '';    
    $link = connectToDB($alert);
    
    // если пользователь отправил файл
    if (!empty($_FILES)) { 
        // если тип файла поддерживается
        if (strpos(SUPPORTED_IMAGE_TYPES, $_FILES['img']['type']) !== false) {
            // подгрузим библиотеку для создания миниатюр
            include_once INCLUDES_DIR . 'resize.php';
            
            // исправим разрешение файла jpg на jpeg
            $filename = $_FILES['img']['name'];
            $filename_parts = pathinfo($filename);            
            if (strtolower($filename_parts['extension']) == 'jpg') {
                $filename = str_ireplace('jpg', 'jpeg', $filename);
            }
            
            // создаём имена файлов
            $img_path = UPLOADS_DIR . $filename;
            $thumb_path = THUMBNAILS_DIR . $filename;
            
            // сохраняем файл картинки в папку загрузок
            if (move_uploaded_file($_FILES['img']['tmp_name'], $img_path)) { 
                // генерируем миниатюру
                create_thumbnail($img_path, $thumb_path, THUMB_WIDTH, THUMB_HEIGHT);
            }
            //$alert = "Файл $filename успешно загружен в галерею";
            
            if ($link) {
                insertImageToDB($link, $filename, $img_path, $_FILES['img']['size']);
            }
            
        } else {
            // сообщим, если тип файла не поддерживается
            $alert = "Формат файла {$_FILES['img']['type']} не поддерживается";
        }
    }
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
                    <?= render('menu') ?>
            </div>				

            <div class="content">
                <div class="galary">
                    <?php

                        $images = getImages($link);
                        if (!empty($images))
                            foreach ($images as $id => $filename) {
                                $thumbnail = THUMBNAILS_DIR . $filename;
                                $width = THUMB_WIDTH;
                                echo <<<HTML
                                <div class="image">
                                    <a href="image_viewer.php?id=$id"><img src="$thumbnail" alt="$filename" width=$width></a>
                                </div>
HTML;
                            }

                    ?>
                    <div class="clearfix"></div>
                </div>    
                <form class="img_upload_form" action="galary.php" enctype="multipart/form-data" method="post">
                    <input type="file" name="img" accept="image/jpeg,image/png,image/gif" />
                    <input type="submit" value="Загрузить картинку" />
                </form>
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

