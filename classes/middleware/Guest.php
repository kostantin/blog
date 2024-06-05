<?php

namespace classes\middleware;

class Guest
{
    public function handle()
    {
        if (isAuth()) {
            redirect('/');
        }
    }

}