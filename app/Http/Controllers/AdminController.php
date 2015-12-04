<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Sentinel;

class AdminController extends Controller
{

    public function index()
    {

        // dd(Sentinel::findById(1));

        return view('layouts.admin.dashboard');
    }

}
