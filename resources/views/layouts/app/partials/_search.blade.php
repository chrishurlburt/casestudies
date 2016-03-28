<section id="search">

    {!! Form::open(['route' => 'app.search', 'class' => 'keyword']) !!}
        <div class="form-group keyword-search">
            <input type="search" name="keywords" placeholder="Keyword Search" class="form-control keyword-search-field">
            <button type="submit" class="search">
                <i class="fa fa-search"></i>
            </button>

        </div>
    {!! Form::close() !!}

    <div class="other-search-options">
        <a data-toggle="collapse" href="#search-options" aria-expanded="false" aria-controls="search-options"><i class="fa fa-plus"></i> Other Search Options</a>
            <div class="collapse" id="search-options">
                <div class="well">

                    {!! Form::open(['route' => 'app.search']) !!}

                        <h3>Outcome Search</h3>

                        @include('layouts.app.partials._outcomes')

                        <button type="submit" class="btn btn-primary">
                            Search Outcomes
                        </button>

                        {!! Form::close() !!}

                        {!! Form::open(['route' => 'app.search']) !!}

                        <h3>Courses Search</h3>

                        @include('layouts.app.partials._courses')

                        <button type="submit" class="btn btn-primary">
                            Search Courses
                        </button>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </section>