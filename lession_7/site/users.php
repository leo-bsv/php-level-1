<?php  
    require_once 'config.php';
    require_once INCLUDES_DIR . 'session.php';   
    require_once INCLUDES_DIR . 'db_proc.php';     
    require_once INCLUDES_DIR . 'utils.php';
    require_once INCLUDES_DIR . 'render.php';
    require_once INCLUDES_DIR . 'users_proc.php';
    
    $h1 = 'Стальные двери';
    $title = 'Пользователи';
    $year = date("Y");   
    
    $alert = '';
    $link = connectToDB($alert);
    
    $users = getUsers($link);
    
    $deleteUser = getReqAsInt('del');
    if ($deleteUser) {
        if (!deleteUser($link, $deleteUser))
            $alert = 'Ошибка при удалении пользователя!';
    }
    
    $login = escapeString($link, getReqAsStr('login'));
    $pass = escapeString($link, getReqAsStr('pwd'));
    
    if (!empty($login) && !empty($pass)) {
        if (!registerUser($link, $login, $pass))
            $alert = 'Ошибка при регистрации пользователя!';
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
                <h2>Пользователи</h2>
                <table>
                    <tr>
                        <th>№№</th>
                        <th>Логин</th>
                        <th>Действие</th>
                    </tr>
                    <?php foreach ($users as $id => $login): ?>
                        <tr>
                            <td><?= $id ?></td>
                            <td><?= $login ?></td>
                            <td><a href="users.php?del=<?= $id ?>">Удалить</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="clearfix"></div>
                <h2>Добавление пользователя</h2>
                <form action="users.php" method="post">
                    <label for="login">Логин</label>
                    <input id="login" name="login" type="text" required="">
                    <br>
                    <label for="pwd">Пароль</label>
                    <input id="pwd" name="pwd" type="password" required="">
                    <br>
                    <input type="submit" value="Создать пользователя">
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

