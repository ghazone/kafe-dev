<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function homepage()
    {
        return view('user.hompage');
    }
}
