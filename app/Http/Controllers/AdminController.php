<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Sentinel;
use \Auth;
use \Route;

class AdminController extends Controller
{

    public function index()
    {
        return view('layouts.admin.dashboard');
    }

    public function accounts()
    {

        $user = Sentinel::findById(Auth::user()->id);

        dd($user->hasAccess(['admin.accounts']));



        // if (!$user->hasAccess(Route::currentRouteName())) {
        //     return redirect('admin')->withErrors(['auth'=>'Permission Denied.']);
        // }

    }

}
