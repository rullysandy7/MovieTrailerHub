<?php

namespace App\Controllers;

class Basis extends BaseController
{
    public function index()
    {
        $x["hal"] = "film";
        return view("home", $x);
    }
}
