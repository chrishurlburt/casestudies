<?php

namespace App\Helpers;

use Request;

use \Auth;
use \Session;
use \Sentinel;

class Helpers
{

    /**
     * Flash a message to the session
     *
     * @param string $message
     * @return null
     */
    public static function flash($message)
    {
        return Session::flash('flash_message', $message);
    }


    /**
     * Check if a user has access to a route.
     *
     * @return bool
     */
    public static function checkAccess()
    {

        $user = Sentinel::findById(Auth::user()->id);

        if($user->hasAccess([Request::route()->getName()])) {
            return true;
        } else {
            return false;
        }

    }

}