<?php

namespace App\Controllers;

class Keluhan extends BaseController
{
    public function formLangsung(): string
    {
        return view('keluhan-form-langsung');
    }
}