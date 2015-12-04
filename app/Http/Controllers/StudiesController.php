<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Study;
use App\Keyword;

class StudiesController extends Controller
{

    /**
    * Show all of the case studies in the admin panel.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {

        $studies = Study::latest()->get();

        return view('layouts.admin.studies.manage')->with('studies', $studies);
    }


    /**
    * Create a new case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('layouts.admin.studies.create');
    }


    /**
    * Store a new case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
        $input = Request::all();

        $keywords = $this->getKeywords($input);
        $this->storeKeywords($keywords);

        // get the ids of the keywords by name that were just added, then pass the array
        // of ids to $study->keywords()->attach($keywordIds)
        // dd($errors);


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


    /**
    * Update an existing case study.
    *
    * @return \Illuminate\Http\Response
    */
    public function update()
    {
        dd('update a case study -- studies controller');
    }


    /**
    * Get the keyword string from $input and format to an array.
    *
    * @param array $input
    * @return array
    */
    private function getKeywords($input)
    {
        return array_map('trim', explode(',',$input['keywords']));
    }


    /**
    * Get the keyword string from $input and format to an array.
    *
    * @param array $keywords
    * @return null
    */
    private function storeKeywords($keywords)
    {
        foreach($keywords as $k) {
            $keyword = new Keyword;
            $keyword->name = $k;
            $keyword->save();
        }
    }

}
