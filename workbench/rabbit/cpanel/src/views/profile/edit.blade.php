@extends(Config::get('cpanel::layout.master'))

@section('content')

    <ul class="nav nav-tabs">
        <li class="active"><a href="#general_tab" data-toggle="tab">General <i class="fa"></i></a></li>
    </ul>
    {{ Former::vertical_open()
           ->action(URL::route('cpanel.profile.update', $data->id))
           ->method('put')
           ->id('bvForm') }}
    <div class="tab-content">
        <div class="tab-pane active" id="general_tab">
            <div class="row">
                <div class="col-md-6">
                    {{ Former::text('full_name')
                           ->autofocus()
                           ->value($data->full_name)
                           ->required() }}
                    {{ Former::text('email')
                            ->value($data->email)
                          ->required() }}
                    {{ Former::text('username')
                           ->autocomplete('off')
                           ->value($data->username)
                           ->required() }}
                    {{ Former::password('password_old')
                           ->maxlength(15)
                           ->minlength(6)
                           ->required() }}
                </div>
                <div class="col-md-6">
                    {{ Former::password('password')
                           ->maxlength(15)
                           ->minlength(6)
                           ->required() }}
                    {{ Former::password('password_confirmation')
                           ->required() }}
                    {{ ($password_action) ? Former::password('password_action')
                           ->maxlength(15)
                           ->minlength(6) : '' }}
                </div>
            </div>
        </div>
    </div>

    {{ Former::primary_submit('Update') }}
    {{ Former::reset('Reset') }}
    {{ Former::close() }}
@stop

@section('js')
    <script>
        // BV
        var url = "{{ URL::route('cpanel.validator.profile') }}";
        var id = "{{ $data->id }}";
        $('#bvForm').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                email: {
                    validators: {
                        emailAddress: {},
                        remote: {
                            type: 'POST',
                            url: url,
                            data: function (validator) {
                                return {id: id};
                            }
                        }
                    }
                },
                username: {
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
                password_old: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url
                        }
                    }
                },
                password: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        identical: {
                            field: 'password'
                        }
                    }
                },
                password_action: {
                    validators: {
                        remote: {
                            type: 'POST',
                            url: url
                        }
                    }
                }
            }
        });

    </script>
@stop
