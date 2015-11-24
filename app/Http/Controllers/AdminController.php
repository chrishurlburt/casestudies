<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        dd('admin dashboard');
    }

    public function studies()
    {
        dd('list of case studies in admin dashboard');
    }

    public function newstudy()
    {
        dd('admin interface to add new case study');
    }

}
