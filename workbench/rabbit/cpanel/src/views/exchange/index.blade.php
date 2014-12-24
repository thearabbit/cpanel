@extends(Config::get('cpanel::layout.master'))

@section('toolbar')
    {{ Button::primary('Add New')->asLinkTo(URL::route('cpanel.exchange.create')) }}
@stop

@section('content')
    {{ Datatable::table()
                   ->addColumn('Exchange Date', 'Khr-Usd', 'Usd', 'Khr-Thb', 'Thb', 'Memo', 'Action')
                   ->setUrl(route('cpanel.datatable.exchange'))
                   ->render() }}
@stop
