<img class="bigpic" src="<?= $productImageFilename ?>" alt="<?= $productName ?>">                
<h2><?= $productName ?></h2>
<h3>Описание</h3>
<?= $productShortDescr ?>
<h3>Характеристики</h3>
<?= $productFeature ?>
<h3>Подробное описание</h3>
<?= $productLongDescr ?>
<h3>Цена товара</h3>
<?= $productPrice ?>
<h3>Остаток на складе</h3>
<?= $productCount ?>
<a class="buy-button" href="/cart/put/<?= $productId ?>">Купить</a>
<?= $editLink ?>
<?= $deleteLink ?>
<div class="clearfix"></div>	