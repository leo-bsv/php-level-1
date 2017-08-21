<div class="image">
    <img src="<?= $imagePath ?>" alt="picture"><br>
</div>
<p>Просмотров изображения: <?= $imageViews ?></p>
<?php if (!empty($imageComments)): ?>
    <h2>Отзывы</h2>
<?php endif; ?>
<?php foreach ($imageComments as $imageComment): ?>
    <p>
        <?= $imageComment['comment'] ?><br>
        Автор: <b><?= $imageComment['author'] ?></b>
    </p>
<?php endforeach; ?>
<?= $imageCommentForm ?>