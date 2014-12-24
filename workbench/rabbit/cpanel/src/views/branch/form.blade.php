@extends(Config::get('cpanel::layout.master'))

@section('css')
@stop

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a href="#general_tab" data-toggle="tab">General <i class="fa"></i></a></li>
        <li><a href="#contact_tab" data-toggle="tab">Contact <i class="fa"></i></a></li>
    </ul>

    {{ Former::vertical_open()
           ->action($form->action)
           ->method($form->method)
           ->id('bvForm') }}
    <div class="tab-content">
        <div class="tab-pane active" id="general_tab">
            <div class="row">
                <div class="col-md-6">
                    {{ Former::textarea('kh_name')
                           ->value($data->kh_name)
                           ->autofocus()
                           ->required() }}
                    {{ Former::text('kh_short_name')
                           ->value($data->kh_short_name)
                           ->required() }}
                </div>
                <div class="col-md-6">
                    {{ Former::textarea('en_name')
                           ->value($data->en_name)
                           ->required() }}
                    {{ Former::text('en_short_name')
                           ->value($data->en_short_name)
                           ->required() }}
                </div>
            </div>
        </div>


        <div class="tab-pane" id="contact_tab">
            <div class="row">
                <div class="col-md-6">
                    {{ Former::textarea('kh_address')
                           ->value($data->kh_address)
                           ->required() }}
                    {{ Former::textarea('en_address')
                           ->value($data->en_address)
                           ->required() }}
                </div>
                <div class="col-md-6">
                    {{ Former::text('telephone')
                           ->value($data->telephone)
                           ->required() }}
                    {{ Former::text('email')
                           ->value($data->email) }}
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
        var url = "{{ URL::route('cpanel.validator.branch') }}";
        var id = "{{ $data->id }}";
        $('#bvForm').bootstrapValidator({
            live: "disabled",
            excluded: [':disabled'],
            fields: {
                kh_name: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url,
                            data: function (validator) {
                                return {id: id};
                            }
                        }
                    }
                },
                kh_short_name: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url,
                            data: function (validator) {
                                return {id: id};
                            }
                        }
                    }
                },
                en_name: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url,
                            data: function (validator) {
                                return {id: id};
                            }
                        }
                    }
                },
                en_short_name: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url,
                            data: function (validator) {
                                return {id: id};
                            }
                        }
                    }
                },
                email: {
                    validators: {
                        emailAddress: {}
                    }
                }
            }
        });
    </script>
@stop
