<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Study;

class StudiesController extends Controller
{

    public function index()
    {
        dd('show all case sudies -- Studies Controller');
    }

    public function create()
    {
        return view('layouts.admin.studies.create');
    }

    public function store()
    {
        $input = Request::all();

        $study = new Study;

        $study->name = $input['title'];
        $study->problem = $input['problem'];
        $study->solution = $input['solution'];
        $study->analysis = $input['analysis'];
        $study->slug = $input['slug'];

        // dd($study);

        $study->save();

        return redirect('/');
    }

    public function update()
    {
        dd('update a case study -- studies controller');
    }

}
