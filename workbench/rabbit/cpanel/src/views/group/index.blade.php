@extends(Config::get('cpanel::layout.master'))

@section('toolbar')
    {{ Button::primary('Add New')->asLinkTo(URL::route('cpanel.group.create')) }}
@stop

@section('content')
    {{ Datatable::table()
                   ->addColumn('ID', 'Name', 'Package', 'Permission', 'Action')
                   ->setUrl(route('cpanel.datatable.group'))
                   ->render() }}
@stop
