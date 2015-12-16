<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OutcomesController extends Controller
{

    public function index()
    {
        dd('show all outcomes -- outcomes Controller');
    }

    public function create()
    {
        dd('create a new outcome -- outcomes controller');
    }

    public function update()
    {
        dd('update an outcome -- outcomes controller');
    }

    public function store()
    {
        dd('store an outcome');
    }

    public function destroy()
    {
        dd('delete an outcome');
    }

    public function show()
    {
        dd('show an outcome');
    }

    public function edit()
    {
        dd('edit an outcome');
    }

}
