@extends('cpanel::generator.layout')

@section('content')
    {{--Angular--}}
    <div ng-app="GeneratorApp">
        <h2>Scaffold</h2>
        <hr>

        @if(Session::has('success'))
            <?php $data = Session::get('data'); ?>
            <h4>
                Please run command:
                <code>
                    php artisan migrate --bench="{{ $data->vendor }}/{{ $data->package }}"
                </code>
            </h4>
        @endif

        {{ Former::vertical_open()->action(URL::route('generator.scaffold.store'))->method('post') }}

        <table width="100%">
            <tr>
                <td>{{ Former::text('vendor')->value('rabbit')->required() }}</td>
                <td>{{ Former::text('package')->value('cpanel')->required() }}</td>
            </tr>

            <tr>
                <td>{{ Former::text('resource_prefix')->value('tbl_') }}</td>
                <td>{{ Former::text('resource')->value('post_comment')->required() }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered" width="100%" ng-controller="ItemController">
                        <tr style="text-align: center; font-weight: bold">
                            <td><u>Field Name*</u></td>
                            <td><u>Type*</u></td>
                            <td><u>Length</u></td>
                            <td><u>Decimal</u></td>
                            <td><u>Null</u></td>
                            <td><u>Default</u></td>
                            <td><u>US</u></td>
                            <td><u>View</u></td>
                            <td><u>Form</u></td>
                            <td></td>
                        </tr>
                        <tr ng-repeat="item in items">
                            <td>{{ Former::text('field[]', '') }}</td>
                            <td>{{ Former::select('type[]', '')->options($types) }}</td>
                            <td>{{ Former::text('length[]', '') }}</td>
                            <td>{{ Former::text('decimal[]', '') }}</td>
                            <td>{{ Form::checkbox('nullable[]') }}</td>
                            <td>{{ Former::text('default[]', '') }}</td>
                            <td>{{ Form::checkbox('unsigned[]') }}</td>
                            <td>
                                {{ Form::checkbox('show[]') }}
                                {{ Form::hidden('rule[]', '') }}
                            </td>
                            <td>
                                {{ Former::select('form_object[]', '')->options($form_object) }}
                            </td>
                            <td>
                                {{ Former::danger_button('-')->ng_click('items.splice($index, 1)') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10" style="text-align: right">
                                {{ Former::success_button('+')->ng_click('addItem()') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr style="text-align: right">
                <td colspan="2">{{ Former::primary_submit('Generate') }}</td>
            </tr>

        </table>

        {{ Former::close() }}


    </div>
    {{--End Angular--}}

@stop

@section('js')
    <script>
        var app = angular.module("GeneratorApp", []);

        app.controller("ItemController", function ($scope) {
            var counter = 0;

            $scope.items = [
                {
                    id: counter
                }
            ];

            $scope.addItem = function () {
                counter++;
                $scope.items.push({
                    id: counter
                });
            };

        });

    </script>
@stop