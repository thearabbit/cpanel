@extends(Config::get('cpanel::layout.login'))

@section('content')

    <div class="header bg-blue"><i class="fa fa-sign-in"></i> Log In</div>
    {{ Former::vertical_open()
        ->action(URL::route('cpanel.post_login'))
        ->method('post')
        ->autocomplete('on') }}
    <div class="body bg-gray">
        {{ Notification::showAll() }}

        {{ Former::text('username', '')
            ->autocomplete('off')
            ->autofocus()
            ->placeholder('user name')
            ->prepend('<i class="fa fa-user"></i>')
            ->required() }}
        {{ Former::password('password', '')
            ->placeholder('user password')
            ->prepend('<i class="fa fa-lock"></i>')
            ->required() }}
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-md-12">
                {{ Former::submit('Log In')->class('btn bg-light-blue btn-block') }}
            </div>
        </div>
    </div>
    {{ Former::close() }}

@stop