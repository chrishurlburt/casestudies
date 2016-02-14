@extends('admin-base')

@section('content')

@include('layouts.admin.partials._heading', ['heading' => $user->first_name.'\'s'.' '.'Profile'])

{!! Breadcrumbs::render('profile') !!}

@include('layouts.admin.partials._success')
@include('layouts.admin.partials._errors')

<h3>Email</h3>
<p>{{ $user->email }}</p>

<h3>Notifications</h3>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Notifications
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>

<h3>My Case Studies</h3>
<ul>
@foreach($studies as $study)
    <li>{!! $study->title !!}</li>
@endforeach
</ul>

<div class="row">
    <div class="col-lg-12">
        <a href="{{ route('admin.profile.password') }}"><button class="btn btn-primary form-control">Change Password</button></a>
    </div>
</div>


@stop