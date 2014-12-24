@extends(Config::get('cpanel::layout.master'))

@section('toolbar')
    {{ Button::primary('Add New')->asLinkTo(URL::route('cpanel.branch.create')) }}
@stop

@section('content')
    {{ Datatable::table()
                   ->addColumn('ID', 'Kh Name', 'Kh Short Name', 'En Name', 'En Short Name', 'Telephone', 'Action')
                   ->setUrl(route('cpanel.datatable.branch'))
                   ->render() }}
@stop
