<h2><?= $actionLabel ?></h2>
<form action="<?= $action ?>" enctype="multipart/form-data" method="post">   
    <div>
        <label class="label" for="product_name">Название товара</label>
        <input class="field" required="" type="text" name="productName" id="product_name" placeholder="название товара..." value="<?= $productName ?>">
    </div>
    <div>
        <label class="label" for="product_price">Цена товара</label>
        <input class="field" required="" type="numeric" name="productPrice" id="product_price" value="<?= $productPrice ?>">
    </div>
    <div>
        <label class="label" for="product_count">Количество товара</label>
        <input class="field" required="" type="numeric" name="productCount" id="product_count" value="<?= $productCount ?>">
    </div>
    <div class="mapflex">
        <label class="label" for="short_descr">Краткое описание товара</label>
        <textarea class="message" name="productShortDescr" id="short_descr" placeholder="краткое описание товара..."><?= $productShortDescr ?></textarea>
    </div>    
    <div class="mapflex">
        <label class="label" for="feature">Характеристики товара</label>
        <textarea class="message" name="productFeature" id="feature" placeholder="характеристики товара..."><?= $productFeature ?></textarea>
    </div>    
    <div class="mapflex">
        <label class="label" for="img">Изображение товара</label>
        <input type="file" name="productImage" id="img" accept="image/jpeg,image/png,image/gif" />
    </div>    
    <div class="mapflex">
        <label class="label" for="long_descr">Полное описание товара</label>
        <textarea class="message" name="productLongDescr" id="long_descr" placeholder="полное описание товара..."><?= $productLongDescr ?></textarea>
    </div>       
    <div class="buttons">
        <input type="reset" value="Очистить">&nbsp;
        <input type="submit" value="Отправить">
    </div>
</form>