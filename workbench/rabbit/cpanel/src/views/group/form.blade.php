@extends(Config::get('cpanel::layout.master'))

@section('css')
@stop

@section('content')
    <div ng-app="ngApp" ng-controller="GroupController" block-ui="main" class="block-ui-main">

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
                        {{ Former::text('name')
                               ->value($data->name)
                               ->autofocus()
                               ->required() }}
                        {{ Former::select('package')
                               ->options(CpanelList::package(false))
                               ->value($data->package)
                               ->select2()
                               ->ng_model('package')
                               ->ng_change('packageChange(package)')
                               ->placeholder('- Select One -')
                               ->required() }}
                    </div>
                    <div class="col-md-6">
                        {{ Former::select('permission[]')
                               ->multiple()
                               ->size(6)
                               ->ng_model('permission')
                               ->ng_options('permission.name group by permission.group for permission in permissions track by permission.id')
                               ->required() }}
                    </div>
                </div>
            </div>
        </div>

        {{ Former::primary_submit($form->submit) }}
        {{ Former::reset('Reset') }}
        {{ Former::close() }}

    </div>
@stop

@section('js')
    <script>
        // BV
        var url = "{{ URL::route('cpanel.validator.group') }}";
        var id = "{{ $data->id }}";
        $('#bvForm').bootstrapValidator({
            live: "disabled",
            excluded: [':disabled'],
            fields: {
                name: {
                    validators: {
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

        // Angular
        var app = angular.module("ngApp", ["blockUI"]);

        app.controller('GroupController', function ($scope, $http, blockUI) {

            $scope.package = "{{ $data->package }}";
            $scope.permissions = {{ $permissions }};
            $scope.permission = {{ $permission }};

            $scope.packageChange = function (val) {
                blockUI.start();
                $http({
                    method: "post",
                    url: "{{ URL::route('cpanel.package_change.group') }}",
                    params: {package: val}
                })
                        .success(function (data) {
                            $scope.permissions = data;
                        })
                        .error(function (data) {
                            alert('Error!');
                        });
                blockUI.stop();
            };
        });

    </script>
@stop
