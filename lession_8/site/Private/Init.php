<?php

/**
*
* Автор: Бурков Сергей aka Leo.
*
* Домашнее задание к уроку № 8.
*
*/

// подгрузим автозагрузчик классов
require_once 'Core/Autoloader.php';

$app = new App();
$app->routing();
unset($app);