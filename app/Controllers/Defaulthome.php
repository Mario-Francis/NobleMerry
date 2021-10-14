<?php

namespace App\Controllers;

class Defaulthome extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
}
