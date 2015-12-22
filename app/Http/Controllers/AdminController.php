<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Sentinel;
use \Auth;
use \Route;

use App\Notification;
use App\Helpers\Helpers;

class AdminController extends Controller
{

    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->take(10)->get();

        return view('layouts.admin.dashboard')->with('notifications', $notifications);
    }

    public function accounts()
    {

        // @TODO: authorization on admin.account resource routes

        $user = Sentinel::findById(Auth::user()->id);

        dd($user->hasAccess(['admin.accounts']));



        // if (!$user->hasAccess(Route::currentRouteName())) {
        //     return redirect('admin')->withErrors(['auth'=>'Permission Denied.']);
        // }

    }


    /**
     * Get a users notifications.
     *
     * @return Illuminate\Http\Response
     */
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->get()->all();

        return view('layouts.admin.notifications.manage')->with('notifications', $notifications);

    }


    /**
     * Detach notifications from a user.
     *
     * @return  null
     */
    public function destroyNotification(Request $request)
    {

        Auth::user()->notifications()->detach($request->input('notifications'));

        return redirect(route('admin.notifications'))->with(Helpers::flash('The selected notifications have been deleted.'));

    }
}
