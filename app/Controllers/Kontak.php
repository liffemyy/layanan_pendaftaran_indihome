<?php

namespace App\Controllers;

class Kontak extends BaseController
{
    public function index(): string
    {
        return view('kontak');
    }
}