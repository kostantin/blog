<?php require_once ROOT . '/views/includes/header.tpl.php' ?>

<main class="main py-5 mx-auto">

    <?php foreach ($posts as $post) : ?>
    <div class="card" style="width: 40rem;">
        <div class="card-body">
            <h5 class="card-title"><?= h($post['title']) ?></h5>
            <p class="card-text"><?= h($post['content']) ?></p>
            <a href="#" class="card-link">Card link</a>
        </div>
    </div>
    <?php endforeach; ?>
</main>

<?php require_once ROOT . '/views/includes/footer.tpl.php' ?>
