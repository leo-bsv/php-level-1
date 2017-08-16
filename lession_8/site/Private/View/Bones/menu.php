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