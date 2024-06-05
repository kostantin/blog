<?php require_once ROOT . '/views/includes/header.tpl.php' ?>

    <main class="main py-3 mx-auto">

        <div class="card" style="width: 50rem;">
            <div class="card-body">
                <form action="new" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Название поста</label>
                        <input name="title" type="text" class="form-control" id="title">
                        <?= isset($validation) ? $validation->listErrors('title') : '' ?>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Example textarea</label>
                        <textarea name="content" class="form-control" id="content" rows="15"></textarea>
                        <?= isset($validation) ? $validation->listErrors('content') : '' ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </main>

<?php require_once ROOT . '/views/includes/footer.tpl.php' ?>