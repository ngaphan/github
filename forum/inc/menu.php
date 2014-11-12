<ul class="nav nav-pills ">
    <?php foreach (getCategories() as $aMenuCategory): ?>
        <li><a href="category.php?id=<?= $aMenuCategory['id']; ?>"><?= $aMenuCategory['name']; ?></a></li>
    <?php endforeach; ?>
</ul>