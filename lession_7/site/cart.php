<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'session.php';   
    require_once INCLUDES_DIR . 'db_proc.php';     
    require_once INCLUDES_DIR . 'utils.php';
    require_once INCLUDES_DIR . 'render.php';
    require_once INCLUDES_DIR . 'cart_proc.php';    
    
    $h1 = 'Стальные двери';
    $title = 'Корзина';
    $year = date("Y");   
    
    $alert = '';
    $link = connectToDB($alert);
    
    $goods = getCartList($link);

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
                <h2>Корзина</h2>
                <table>
                    <tr>
                        <th>№№</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Действие</th>
                    </tr>
                    <?php foreach ($goods as $key => $product): ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td><a href="cart.php?del=<?= $product['id'] ?>">Удалить</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2" style="text-align: right">Итого:</td>
                        <td><?= $itog ?></td>
                        <td style="border: 0"></td>
                    </tr>
                </table>
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

