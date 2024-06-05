<?php

global $db;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $validator = new \classes\Validator();

    $data = $validator->load(['name', 'email', 'password']);

    $rules = [
        'name' => [
            'required' => true,
            'max' => 10,
            'min' => 2,
        ],
        'email' => [
            'email' => true,
            'max' => 20,
            'unique' => 'users:email'
        ],
        'password' => [
            'required' => true,
            'max' => 20,
            'min' => 6,
        ],
    ];

    $validation = $validator->validate($data, $rules);

    if (!$validation->hasErrors()) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (?, ?, ?)", [$data['name'], $data['email'], $data['password']])) {
            $_SESSION['success'] = 'Вы успешно зарегистрировались';
        } else {
            $_SESSION['error'] = 'DB Error';
        }
      redirect(PATH);
    }

}

require_once ROOT . '/views/register.tpl.php';
