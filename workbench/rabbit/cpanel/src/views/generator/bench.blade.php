@extends('cpanel::generator.layout')

@section('content')
    <h2>Workbench</h2>
    <hr>

    @if(Session::has('msg'))
        <h4>
            {{ Session::get('msg') }}
        </h4>
    @endif

    {{ Former::vertical_open()->action(URL::route('generator.bench.store'))->method('post') }}

    <div class="row">
        <div class="col-md-6">
            {{Former::text('bench')->value('rabbit')->required() }}
        </div>
        <div class="col-md-6">
            {{Former::text('package')->value('package')->required() }}
        </div>
    </div>

    {{ Former::primary_submit('Generate') }}

    {{ Former::close() }}

@stop
