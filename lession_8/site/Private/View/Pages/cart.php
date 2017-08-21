<h2>Корзина</h2>
<?php if (empty($goods)): ?>
<p>В вашей корзине пока нет товаров.</p>
<?php else: ?>
<table>
    <tr>
        <th>№№</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Действие</th>
    </tr>
    <?php foreach ($goods as $key => $product): ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><a href="cart/delete/<?= $product['id'] ?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="2" style="text-align: right">Итого:</td>
        <td><?= $itog ?></td>
        <td style="border: 0"></td>
    </tr>
</table>
<?php endif; ?>
<div class="clearfix"></div>