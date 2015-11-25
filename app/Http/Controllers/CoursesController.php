<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{

    public function index()
    {
        dd('show all courses -- courses Controller');
    }

    public function create()
    {
        dd('create a new course -- courses controller');
    }

    public function update()
    {
        dd('update a course -- courses controller');
    }

}
