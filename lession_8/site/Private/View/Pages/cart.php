<h2>Корзина</h2>
<?php if (empty($goods)): ?>
<p>В вашей корзине пока нет товаров.</p>
<?php else: ?>
<table>
    <tr>
        <th>ID</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Действие</th>
    </tr>
    <?php foreach ($goods as $product): ?>
        <tr>
            <td><?= $product['goods_id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><a href="cart/delete/<?= $product['id'] ?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="2" style="text-align: right">Итого:</td>
        <td><?= $sum ?>.00</td>
        <td style="border: 0"></td>
    </tr>
</table>
<?php endif; ?>
<div class="clearfix"></div>