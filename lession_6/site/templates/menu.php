<?php
/**
 * Меню сайта
 */

$menu = [
    ['link' => 'index.php', 'caption' => 'Главная'],
    ['link' => 'galary.php', 'caption' => 'Галерея'],
    ['link' => 'calc.php', 'caption' => 'Калькулятор'],
    ['link' => 'catalog.php', 'caption' => 'Каталог'],
    ['link' => 'contacts.php', 'caption' => 'Контакты']
];

?>

<ul class="menu">
    <?php foreach ($menu as $item): ?>
        <li>
            <a href="<?= $item['link'] ?>">
                <div class="marker"></div>
                <?= $item['caption'] ?>
            </a>
        </li>
    <?php endforeach; ?>                            
</ul>