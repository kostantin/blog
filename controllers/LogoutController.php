<?php

if (isAuth()) {
    unset($_SESSION['user']);
}

redirect('/');
