<section id="search">

    {!! Form::open(['route' => 'app.search', 'class' => 'keyword']) !!}
        <h3>Keyword Search <small>(Enter keywords separated by comma or space)</small></h3>
        <div class="form-group keyword-search">
            <input type="search" name="keywords" class="form-control keyword-search-field">
            <button type="submit" class="btn btn-primary form-control search">
                <i class="fa fa-search"></i>
            </button>

        </div>
    {!! Form::close() !!}

    <div class="other-search-options">
        <a data-toggle="collapse" href="#search-options" aria-expanded="false" aria-controls="search-options"><i class="fa fa-plus"></i> Other Search Options</a>
            <div class="collapse" id="search-options">
                <div class="well">

                    {!! Form::open(['route' => 'app.search']) !!}

                        <div class="form-group">
                            <h3>Outcome Search</h3>
                        </div>

                        @include('layouts.app.partials._outcomes')

                        {!! Form::submit('Search Outcomes', ['class' => 'btn btn-primary form-control']) !!}

                        {!! Form::close() !!}

                        {!! Form::open(['route' => 'app.search']) !!}

                        <div class="form-group">
                            <h3>Courses Search</h3>
                        </div>

                        @foreach($courses as $course)
                            <div class="checkbox">
                                <label for="courses">
                                    {!! Form::checkbox('courses[]', $course->id) !!}
                                    {!! $course->subject_name.' '.$course->course_number !!}
                                </label>
                            </div>
                        @endforeach

                        {!! Form::submit('Search Courses', ['class' => 'btn btn-primary form-control']) !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </section>