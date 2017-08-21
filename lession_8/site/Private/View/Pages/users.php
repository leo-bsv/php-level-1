<h2>Пользователи</h2>
<table>
    <tr>
        <th>№№</th>
        <th>Логин</th>
        <th>Действие</th>
    </tr>
    <?php foreach ($users as $id => $login): ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $login ?></td>
            <td><a href="users/delete/<?= $id ?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="clearfix"></div>