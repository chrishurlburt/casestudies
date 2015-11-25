<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudiesController extends Controller
{

    public function index()
    {
        dd('show all case sudies -- Studies Controller');
    }

    public function create()
    {
        dd('create a new case study -- studies controller');
    }

    public function update()
    {
        dd('update a case study -- studies controller');
    }

}
