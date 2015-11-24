<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Study;
use App\Keyword;
use App\Outcome;
use App\Course;

class AppController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $studies = Study::all();

        return view('home')->with('studies', $studies);
    }

    /**
     * Display a specific case study from the slug.
     *
     * @return \Illuminate\Http\Response
     */
    public function casestudy()
    {

        //get the slug, look up case in db and return view to display it.
        dd('the case you clicked on goes here.');

    }

}
