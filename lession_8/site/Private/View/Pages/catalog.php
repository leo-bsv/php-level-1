<?= $add ?>
<h2>Каталог</h2>
<div class="goods">
<?php foreach ($products as $product): ?>
    <div class="item">
            <h3><?= $product['name'] ?></h3>
            <img src="<?= ModelCatalog::CATALOG_PATH . $product['filename'] ?>" alt="<?= $product['name'] ?>">
            <div><a href="catalog/viewer/<?= $product['goods_id'] ?>">подробнее...</a></div>
    </div>
<?php endforeach; ?>
</div>			
<div class="clearfix"></div>	