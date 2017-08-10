<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'session.php';   
    require_once INCLUDES_DIR . 'users_proc.php';   
    require_once INCLUDES_DIR . 'db_proc.php';     
    require_once INCLUDES_DIR . 'utils.php';
    require_once INCLUDES_DIR . 'render.php';
    require_once INCLUDES_DIR . 'cart_proc.php';
    
    $h1 = 'Стальные двери';
    $title = 'Товар';
    $year = date("Y");   
    
    $alert = ''; 
    $link = connectToDB($alert);
    
    $user = getUserById($link, getUserIdFromSession());
        
    $id = getReqAsInt('id'); 
    $data = getProductById($link, $id);
    extract($data);
    
    $buy = getReqAsInt('buy');
    if ($buy) {
        addProductToCart($link, $productId, $quantity);
        $alert = 'Товар добавлен в корзину!';
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

            <?= render('header') ?>

            <div class="content">
                <h2><?= $name ?></h2>
                <h3>Описание</h3>
                <?= $short_descr ?>
                <h3>Характеристики</h3>
                <?= $feature ?>
                <h3>Подробное описание</h3>
                <img class="bigpic" src="<?= $filename ?>" alt="<?= $name ?>">                
                <?= $long_descr ?>
                
                <a class="buy-button" href="product.php?id=<?= $id ?>&buy=1">Купить</a>
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

