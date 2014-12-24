@extends(Config::get('cpanel::layout.master'))

@section('css')
@stop

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a href="#general_tab" data-toggle="tab">General <i class="fa"></i></a></li>
    </ul>

    {{ Former::vertical_open()
           ->action($form->action)
           ->method($form->method)
           ->id('bvForm') }}
    <div class="tab-content">
        <div class="tab-pane active" id="general_tab">
            <div class="row">
                <div class="col-md-6">
                    {{ Former::text('exchange_date')
                        ->date_picker()
                        ->value($data->exchange_date)
                        ->required() }}
                    {{ Former::number('khr_usd')
                        ->step(1)
                        ->min(100)
                        ->value(round($data->khr_usd))
                        ->required() }}
                    {{ Former::number('usd')
                        ->step(0.01)
                        ->min(1)
                        ->value(round($data->usd))
                        ->required() }}
                </div>
                <div class="col-md-6">
                    {{ Former::number('khr_thb')
                          ->step(1)
                          ->min(100)
                          ->value(round($data->khr_thb))
                        ->required() }}
                    {{ Former::number('thb')
                        ->step(1)
                        ->min(1)
                        ->value(round($data->thb))
                        ->required() }}
                    {{ Former::text('memo')
                        ->value($data->memo) }}

                </div>
            </div>
        </div>
    </div>

    {{ Former::primary_submit($form->submit) }}
    {{ Former::reset('Reset') }}
    {{ Former::close() }}
@stop

@section('js')
    <script>
        // BV
        var url = "{{ URL::route('cpanel.validator.exchange') }}";
        var id = "{{ $data->id }}";
        $('#bvForm').bootstrapValidator({
            live: "disabled",
            excluded: [':disabled'],
            fields: {
                exchange_date: {
                    validators: {
                        date: {format: "YYYY-MM-DD"},
                        remote: {
                            type: 'POST',
                            url: url,
                            data: function (validator) {
                                return {id: id};
                            }
                        }
                    }
                }
            }
        });

    </script>
@stop
