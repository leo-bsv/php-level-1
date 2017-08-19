<div class="galary">
    <?php foreach ($images as $image): ?>
        <div class="image">
            <a href="galary/view/<?= $image['id'] ?>">
                <img src="<?= $image['thumb'] ?>" alt="<?= $image['filename'] ?>" width="<?= $image['width'] ?>">
            </a>
        </div>
    <?php endforeach; ?>
    <div class="clearfix"></div>
</div>
<?= $galary_upload ?>