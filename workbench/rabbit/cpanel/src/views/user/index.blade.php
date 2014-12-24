@extends(Config::get('cpanel::layout.master'))

@section('toolbar')
    {{ Button::primary('Add New')->asLinkTo(URL::route('cpanel.user.create')) }}
@stop

@section('content')
    {{ Datatable::table()
                   ->addColumn('ID', 'Full Name', 'Email', 'Type', 'Activated', 'Group', 'Branch', 'User Name', 'Owner', 'Action')
                   ->setUrl(route('cpanel.datatable.user'))
                   ->render() }}
@stop
