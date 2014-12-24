<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>{{ Config::get('cpanel::package.cpanel.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!----------------->
    <!-- CSS Section -->
    <!----------------->
    {{--bootstrap 3.0.2--}}
    {{ HTML::style('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{--font Awesome--}}
    {{ HTML::style('assets/bower_components/fontawesome/css/font-awesome.min.css') }}
    {{--Ionicons--}}
    {{ HTML::style('assets/bower_components/ionicons/css/ionicons.min.css') }}

    {{--Select2--}}
    {{ HTML::style('assets/bower_components/select2/select2.css') }}
    {{ HTML::style('assets/bower_components/select2/select2-bootstrap.css') }}
    {{--Select2 Bootsrap--}}
    {{--    {{ HTML::style('assets/bower_components/select2-bootstrap-css/select2-bootstrap.css') }}--}}
    {{--Bootstrap Validator--}}
    {{ HTML::style('assets/bower_components/bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}

    {{-- AdminLTE Theme style--}}
    {{ HTML::style('assets/bower_components/adminlte/css/AdminLTE.css') }}

    @yield('css')

    {{--Rabbit style--}}
    {{ HTML::style('assets/rabbit.css') }}

    <link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}"/>

    <!------------------>
    <!--   jQuery     -->
    <!------------------>
    {{ HTML::script('assets/bower_components/jquery/dist/jquery.min.js') }}

</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    @yield('content')

    <div class="margin text-center">
        <span><?php echo Config::get('cpanel::rabbit.copy'); ?></span>
    </div>
</div>


<!---------------->
<!-- JS Section -->
<!---------------->
{{--Bootstrap--}}
{{ HTML::script('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
{{--Angular JS--}}
{{ HTML::script('assets/bower_components/angular/angular.min.js') }}

{{--Select2--}}
{{--    {{ HTML::script('assets/bower_components/select2/select2.min.js') }}--}}
{{ HTML::script('assets/select2-3.4.5.min.js') }}
{{--Bootstrap Validator--}}
{{ HTML::script('assets/bower_components/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}

@yield('js')

<!-- AdminLTE App -->
{{ HTML::script('assets/bower_components/adminlte/js/AdminLTE/app.js') }}

<!-- Rabbit -->
{{ HTML::script('assets/rabbit.js') }}

</body>
</html>