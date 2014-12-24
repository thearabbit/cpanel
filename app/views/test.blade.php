<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    {{--bootstrap 3.0.2--}}
    {{ HTML::style('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{--font Awesome--}}
    {{ HTML::style('assets/bower_components/fontawesome/css/font-awesome.min.css') }}
    {{--Select2--}}
    {{ HTML::style('assets/bower_components/select2/select2.css') }}
    {{ HTML::style('assets/bower_components/select2/select2-bootstrap.css') }}
    {{--    {{ HTML::style('assets/bower_components/select2-bootstrap-css/select2-bootstrap.css') }}--}}
    {{--Bootstrap Validator--}}
    {{ HTML::style('assets/bower_components/bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}
    {{--Bootstrap Datetime Picker--}}
    {{ HTML::style('assets/bower_components/bs-datetimepicker/build/css/bootstrap-datetimepicker.css') }}
    {{--Data Table--}}
    {{--    {{ HTML::style('assets/bower_components/datatables/media/css/jquery.dataTables.min.css') }}--}}

    <style>

        body {
            padding-top: 50px;
        }

        .starter-template {
            padding: 40px 15px;
            text-align: left;
        }

        .select2-container .select2-choice {
            height: 34px;
            border: 0px solid #ccc;
            border-radius: 0px;
            background-color: #fff;
            background-image: none;
        }

        .select2-container,
        .select2-drop,
        .select2-search,
        .select2-search input {
            width: 100%;
        }
    </style>

    <!-- jQuery
    ================================================== -->
    {{ HTML::script('assets/bower_components/jquery/dist/jquery.min.js') }}
    {{--Data Table--}}
    {{ HTML::script('assets/bower_components/datatables/media/js/jquery.dataTables.min.js') }}


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
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="starter-template doc-demo">

        {{ Former::open()->id('bvForm') }}

        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>

        {{ Former::submit() }}

        {{ Former::close() }}


    </div>
</div>
<!-- /.container -->


{{--Bootstrap--}}
{{ HTML::script('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
{{--Angular JS--}}
{{--    {{ HTML::script('assets/bower_components/angular/angular.min.js') }}--}}
{{--Select2--}}
{{--{{ HTML::script('assets/bower_components/select2/select2.js') }}--}}
{{ HTML::script('assets/select2-3.4.5.min.js') }}
{{--Bootstrap Validator--}}
{{ HTML::script('assets/bower_components/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}
{{--Moment--}}
{{ HTML::script('assets/bower_components/moment/min/moment.min.js') }}
{{--Bootstrap Datetime Picker--}}
{{ HTML::script('assets/bower_components/bs-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}

<script>
    $('#datetimepicker1').datetimepicker();
    // BV
    $("#bvForm").bootstrapValidator({
        excluded: ':disabled'
    });
</script>

</body>
</html>