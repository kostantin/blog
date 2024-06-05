<?php

namespace classes\middleware;

class Auth
{
    public function handle()
    {
        if (!isAuth()) {
            redirect('/login');
        }
    }
}