<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ Config::get('cpanel::package.' . CpanelAuth::getGroup()->package . '.name') }}</title>
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
    {{--Date Picker--}}
    {{ HTML::style('assets/bower_components/bootstrap-datepicker/css/datepicker3.css') }}
    {{--Date Range Picker--}}
    {{ HTML::style('assets/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css') }}
    {{--Bootstrap Datetime Picker--}}
    {{ HTML::style('assets/bower_components/bs-datetimepicker/build/css/bootstrap-datetimepicker.css') }}
    {{--Data Table--}}
    {{ HTML::style('assets/bower_components/datatables/media/css/jquery.dataTables.min.css') }}
    {{--Bootstrap Validator--}}
    {{ HTML::style('assets/bower_components/bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}
    {{--Angular Block UI--}}
    {{ HTML::style('assets/bower_components/angular-block-ui/dist/angular-block-ui.min.css') }}


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
<body class="skin-blue">

<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="{{ URL::route(CpanelAuth::getGroup()->package . '.home.index') }}" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        {{ Config::get('cpanel::package.' . CpanelAuth::getGroup()->package . '.name') }}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        @include('cpanel::layout.lte.menu_top')

    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    @include('cpanel::layout.lte.menu_left')

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Header and Breadcrumb -->
        <section class="content-header">
            {{--Header--}}
            <h1>
                @section('page_header')
                    {{ PageHeader::make() }}
                @show
            </h1>

            {{--Breadcrumb--}}
            {{ Breadcrumbs::render() }}
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Alert Message -->
            {{ Notification::showAll() }}

            <!-- Toolbar -->
            <p>@yield('toolbar')</p>

            @yield('content')

        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->

<!---------------->
<!-- JS Section -->
<!---------------->
{{--Angular JS--}}
{{ HTML::script('assets/bower_components/angular/angular.min.js') }}
{{--Angular Select2--}}
{{ HTML::script('assets/bower_components/angular-ui-select2/src/select2.js') }}
{{--Bootstrap--}}
{{ HTML::script('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
{{--Select2--}}
{{--    {{ HTML::script('assets/bower_components/select2/select2.min.js') }}--}}
{{ HTML::script('assets/select2-3.4.5.min.js') }}
{{--Date Picker--}}
{{ HTML::script('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
{{--Moment For Bootstrap Datetime Picker--}}
{{ HTML::script('assets/bower_components/moment/min/moment.min.js') }}
{{--Date Range Picker--}}
{{ HTML::script('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}
{{--Bootstrap Datetime Picker--}}
{{ HTML::script('assets/bower_components/bs-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}
{{--Data Table--}}
{{ HTML::script('assets/bower_components/datatables/media/js/jquery.dataTables.min.js') }}
{{--Bootstrap Validator--}}
{{ HTML::script('assets/bower_components/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}
{{--Angular Block UI--}}
{{ HTML::script('assets/bower_components/angular-block-ui/dist/angular-block-ui.min.js') }}

<!------------------------>
<!-- JS Section (No CSS) -->
<!------------------------>
{{--Boot Box--}}
{{ HTML::script('assets/bower_components/bootbox/bootbox.js') }}
{{--Input Mask--}}
{{ HTML::script('assets/bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.js') }}
{{ HTML::script('assets/bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.date.extensions.js') }}
{{ HTML::script('assets/bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.numeric.extensions.js') }}
{{ HTML::script('assets/bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.extensions.js') }}


@yield('js')


<!-- AdminLTE App -->
{{ HTML::script('assets/bower_components/adminlte/js/AdminLTE/app.js') }}

<!-- Rabbit -->
{{ HTML::script('assets/rabbit_date.js') }}
{{ HTML::script('assets/rabbit.js') }}

<!-- Boot Box Custom (delete confirm) -->
@include('cpanel::layout._partial.bootbox_confirm')

</body>
</html>