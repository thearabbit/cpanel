@extends(Config::get('cpanel::layout.master'))

@section('css')
@stop

@section('content')

    <ul class="nav nav-tabs">
        <li class="active"><a href="#general_tab" data-toggle="tab">General <i class="fa"></i></a></li>
        <li><a href="#security_tab" data-toggle="tab">Security <i class="fa"></i></a></li>
    </ul>

    {{ Former::vertical_open()
           ->action($form->action)
           ->method($form->method)
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
                    {{ Former::select('type')
                           ->options(CpanelList::type(false))
                           ->value($data->type)
                           ->placeholder('- Select One -')
                           ->select2()
                           ->required() }}
                    {{ Former::select('activated')
                         ->options(CpanelList::activated(false))
                         ->value($data->activated)
                         ->placeholder('- Select One -')
                         ->select2()
                         ->required() }}
                </div>
                <div class="col-md-6">
                    {{ Former::select('group[]')
                           ->multiple()
                           ->size(5)
                           ->options(CpanelList::group(false))
                           ->value(json_decode($data->group))
                           ->required() }}
                    {{ Former::select('branch[]')
                           ->multiple()
                           ->size(6)
                           ->options(CpanelList::branch(false))
                           ->value(json_decode($data->branch))
                           ->required() }}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="security_tab">
            <div class="row">
                <div class="col-md-6">
                    {{ Former::text('username')
                           ->autocomplete('off')
                           ->value($data->username)
                           ->required() }}
                    {{ Former::password('password')
                           ->maxlength(15)
                           ->minlength(6)
                           ->required() }}
                </div>
                <div class="col-md-6">
                    {{ Former::password('password_confirmation')
                           ->required() }}
                    {{ Former::password('password_action')
                           ->maxlength(15)
                           ->minlength(6) }}
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
        var url = "{{ URL::route('cpanel.validator.user') }}";
        var id = "{{ $data->id }}";
        $('#bvForm').bootstrapValidator({
            live: "disabled",
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
