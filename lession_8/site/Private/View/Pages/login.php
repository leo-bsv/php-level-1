<div class="uniForm">
    <h2>Авторизация</h2>
    <form action="login" method="post">
        <div>
            <label for="login">Логин</label>
            <input id="login" name="login" type="text" required="">
        </div>
        <div>
            <label for="pwd">Пароль</label>
            <input id="pwd" name="pwd" type="password" required="">
        </div>
        <input type="submit" value="Войти">
    </form>
    <p><a href="<?= $registrationLink ?>">Регистрация на сайте</a></p>
</div>
<div class="clearfix"></div>