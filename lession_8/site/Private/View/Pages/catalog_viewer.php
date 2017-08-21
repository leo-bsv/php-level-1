<h2><?= $productName ?></h2>
<h3>Описание</h3>
<?= $productShortDescr ?>
<h3>Характеристики</h3>
<?= $productFeature ?>
<h3>Подробное описание</h3>
<img class="bigpic" src="<?= $productImageFilename ?>" alt="<?= $productName ?>">                
<?= $productLongDescr ?>

<a class="buy-button" href="/cart/put/<?= $productId ?>">Купить</a>