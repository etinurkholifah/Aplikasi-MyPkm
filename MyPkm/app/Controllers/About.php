<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index()
    {
        return view('/event/about');
    }

    public function Require()
    {
        helper('my');
        requireLogin(); 
    }
}