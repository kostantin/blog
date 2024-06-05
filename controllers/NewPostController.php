<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validator = new \classes\Validator();

    $data = $validator->load(['title', 'content']);

    $validation = $validator->validate($data, [
        'title' => [
            'required' => true,
            'min' => 3,
            'max'=> 20,
        ],
        'content' => [
            'required' => true,
            'min' => 3,
            'max'=> 500,
        ],
    ]);

    if (!$validation->hasErrors()) {
        if (db()->query("INSERT INTO posts (`title`, `content`) VALUES (:title, :content)", $data)) {
            $_SESSION['success'] = 'OK';
        } else {
            $_SESSION['error'] = 'DB Error';
        }
        redirect('/');
    } else {
        require_once ROOT . '/views/new-post.tpl.php';
    }

}


require_once ROOT . '/views/new-post.tpl.php';
