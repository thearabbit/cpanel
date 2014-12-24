<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Rabbit Generator</title>

    <!----------------->
    <!-- CSS Section -->
    <!----------------->
    {{--bootstrap 3.0.2--}}
    {{ HTML::style('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{--font Awesome--}}
    {{ HTML::style('assets/bower_components/fontawesome/css/font-awesome.min.css') }}
    {{--Bootstrap Validator--}}
    {{ HTML::style('assets/bower_components/bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}
    {{--Code Prettify--}}
    {{ HTML::style('assets/bower_components/google-code-prettify/bin/prettify.min.css') }}

    <style>

        body {
            padding-top: 50px;
        }

        .starter-template {
            /*padding: 40px 10px;*/
            text-align: left;
        }

    </style>

    @yield('css')

    <!------------------>
    <!--   jQuery     -->
    <!------------------>
    {{ HTML::script('assets/bower_components/jquery/dist/jquery.min.js') }}
    {{--Bootstrap--}}
    {{ HTML::script('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    {{--Angular JS--}}
    {{ HTML::script('assets/bower_components/angular/angular.min.js') }}
    {{--Bootstrap Validator--}}
    {{ HTML::script('assets/bower_components/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}
    {{--Code Prettify--}}
    {{ HTML::script('assets/bower_components/google-code-prettify/bin/run_prettify.min.js') }}
    {{--Boot Box--}}
    {{ HTML::script('assets/bower_components/bootbox/bootbox.js') }}

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Rabbit Generator</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::route('generator.bench.create') }}">Workbench</a></li>
                <li><a href="{{ URL::route('generator.scaffold.create') }}">Scaffold</a></li>
                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Docs</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="starter-template">

        @yield('content')

        @include('cpanel::generator.doc')

    </div>
</div>
<!-- /.container -->

@yield('js')

</body>
</html>