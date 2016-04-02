<hr />
{!! Form::open(['route' => 'app.results.filter', 'method' => 'PUT']) !!}
{!! Form::submit('Reset Filters', ['class' => 'btn btn-secondary reset', 'name' => 'reset_all']) !!}
{!! Form::close() !!}
