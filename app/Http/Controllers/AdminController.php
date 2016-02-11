<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SetMessageRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Sentinel;
use \Auth;
use \Route;

use App\Notification;
use App\User;
use App\Message;
use App\Helpers\Helpers;

class AdminController extends Controller
{

    public function __construct(){
        // check to see if there's learning outcomes, courses or case studies in the DB.
        // If not, suggest creating them.

        $this->middleware('authorize');
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->take(10)->get();
        $team = User::all();

        return view('layouts.admin.dashboard')->with('notifications', $notifications)->with('team', $team);
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
