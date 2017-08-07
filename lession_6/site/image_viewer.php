<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'db_proc.php';       
    require_once INCLUDES_DIR . 'utils.php';  
    require_once INCLUDES_DIR . 'render.php';  
    
    $h1 = 'Стальные двери';
    $title = 'Просмотр картинки';
    $year = date("Y");
    
    $alert = '';    
    $link = connectToDB($alert);
    
    $id = getReqAsInt('id'); 
    incImageViews($link, $id);
    $views = getImageViews($link, $id);
    $img_path = getPathById($link, $id);
    
    // получаем данные от пользователя
    if (inRequest('commented')) {
        $author = escapeString($link, getReqAsStr('author'));
        $comment = escapeString($link, getReqAsStr('comment'));
        if (!empty($author) && !empty($comment)) {
            if (!insertCommentToDB($link, $id, $author, $comment)) {
                $alert = "Ошибка при добавлении отзыва!"; 
            }
        }
    }
    
    // получаем отзывы из БД
    $comments = getComments($link, $id);
    
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
                <div class="image">
                    <img src="<?= $img_path ?>" alt="picture"><br>
                </div>
                <p>Просмотров: <?= $views ?></p>
                <h2>Отзывы</h2>
                <?php foreach ($comments as $comment): ?>
                <p><?= $comment['comment'] ?><br>Автор: <b><?= $comment['author'] ?></b></p>
                <?php endforeach; ?>
                <h2>Оставьте отзыв</h2>
                <form action="image_viewer.php" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="commented" value="1">
                    <div>
                        <label class="label" for="author">Автор</label>
                        <input class="field" type="text" id="author" name="author" maxlength="255" placeholder="Ваше имя" required>
                    </div>
                    <div class="mapflex">
                        <textarea class="message" name="comment" placeholder="Ваш отзыв"></textarea>
                    </div>
                    <div class="buttons">
                        <input type="reset" value="Очистить">&nbsp;
                        <input type="submit" value="Отправить">
                    </div>
                </form>
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
    <script>
        var msg = '<?= $alert ?>';
        if (msg != '') alert(msg);
    </script>               
</body>

</html>

