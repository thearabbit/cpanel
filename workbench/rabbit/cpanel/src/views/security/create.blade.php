<!DOCTYPE html>
<html>
<head>
    <title>Rabbit Security</title>
    {{ HTML::style('packages/rabbit/cpanel/asset/security.css') }}
</head>
<body>

<div class="security-width">
    <!--    <h2 style="background-color: #357ebd; color: #ffffff; text-align: center;">-->
    <h2 class="security-header-info">
        Please create security file.
    </h2>
    <table class="security-content">

        @if(Session::has('msg'))
            <h3>{{ Session::get('msg') }}</h3>
        @endif

        {{ Form::open(array('url' => URL::route('security'), 'method' => 'post')) }}

        <tr>
            <td>
                {{ Form::label('User Name: ') }}
            </td>
            <td>
                {{ Form::text('username') }}
            </td>
        </tr>

        <tr>
            <td>
                {{ Form::label('Password: ') }}
            </td>
            <td>
                {{ Form::password('password') }}
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                {{ Form::submit('Create Security File') }}
            </td>
        </tr>

        {{ Form::close() }}
    </table>

</div>

</body>
</html>