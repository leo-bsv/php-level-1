<div class="uniForm">
    <h2><?= $title ?></h2>
    <form action="<?= $action ?>" method="post">
        <div>
            <label for="login">Логин</label>
            <input id="login" name="login" type="text" <?= $required ?> value="<?= $login ?>">
        </div>
        <div>
            <label for="pwd">Пароль</label>
            <input id="pwd" name="pwd" type="password" <?= $required ?>>
        </div>
        <div>
            <label for="pwdr">Пароль повторно</label>
            <input id="pwdr" name="pwdr" type="password" <?= $required ?>>
        </div>        
        <div>
            <label for="email">Электронная почта</label>
            <input id="email" name="email" type="email" <?= $required ?> value="<?= $email ?>">
        </div>        
        <input type="submit" value="Войти">
    </form>
</div>
<div class="clearfix"></div>