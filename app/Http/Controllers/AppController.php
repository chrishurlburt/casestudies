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
     * The landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('layouts.app.landing');

    }


    /**
     * All the case studies in the DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function studies()
    {
        $studies = Study::latest()->get();

        return view('layouts.app.studies')->with('studies', $studies);
    }


    public function filter()
    {
        //gets the slug and returns a filtered listing.
        dd('app controller');
    }

    /**
     * Display a specific case study from the slug.
     *
     * @return \Illuminate\Http\Response
     */
    public function study($slug)
    {

        $study = Study::where('slug', $slug)->first();

        return view('layouts.app.single')->with('study', $study);
    }

}
