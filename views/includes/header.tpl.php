<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/favicon.ico">
</head>
<body>

<div class="wrapper">
    <header class="header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/public/assets/img/bootstrap-logo.svg" alt="Logo" width="30" height="24"
                         class="d-inline-block align-text-top">
                    Blog
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav list-unstyled ms-auto d-flex align-items-center">
                        <?php if (isAuth()): ?>
                            <li class="nav-item ms-auto me-3"><?= $_SESSION['user']['name']; ?></li>
                            <li class="nav-item ms-auto me-3"><a class="btn btn-outline-primary" href="new">Create post</a></li>
                            <li class="nav-item ms-auto"><a class="btn btn-outline-primary" href="logout">Logout</a></li>
                        <?php else: ?>
                            <li class="nav-item ms-auto me-3"><a class="btn btn-outline-primary" href="register">Register</a></li>
                            <li class="nav-item ms-auto"><a class="btn btn-outline-primary" href="login">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

