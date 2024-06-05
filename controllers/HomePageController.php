<?php


$posts = db()->query("SELECT * FROM posts")->findAll();



require_once ROOT . '/views/home-page.tpl.php';
