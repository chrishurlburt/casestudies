<hr />
{!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
{!! Form::submit('Reset Filters', ['class' => 'btn btn-primary form-control', 'name' => 'reset_all']) !!}
{!! Form::close() !!}
