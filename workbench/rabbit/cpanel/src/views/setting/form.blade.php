@extends(Config::get('cpanel::layout.login'))

@section('css')
@stop

@section('content')

    <div class="header bg-blue">
        <i class="fa fa-cogs"></i> Setting
    <span style="font-size: 14px">
        [ <i class="fa fa-user"></i> {{ Auth::user()->full_name }} ]
   </span>
    </div>

    {{ Former::vertical_open()
        ->action(URL::route('cpanel.setting.store'))
        ->method('post')
        ->id('bvForm') }}
    <div class="body bg-gray">
        {{ Notification::showAll() }}

        {{
            Former::select('group', '')
            ->options(CpanelList::groupPermission(false))
            ->value($group)
            ->select2()
            ->autofocus()
            ->placeholder('- Select Group -')
            ->prepend('<i class="fa fa-group"></i>')
            ->required()
        }}
        {{ Former::select('branch', '')
                ->options(CpanelList::branchPermission(false))
                ->value($branch)
                ->placeholder('- Select Branch -')
                ->select2()
                ->prepend('<i class="fa fa-sitemap"></i>')
                ->required()
        }}
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-md-9">
                {{ Former::submit('Go . . .')->class('btn bg-light-blue btn-block') }}
            </div>
            <div class="col-md-3">
                <a href="{{ URL::route('cpanel.logout') }}" title="Log Out" class="btn btn-danger btn-block"
                   role="button"><i class="fa fa-power-off"></i></a>
            </div>
        </div>
    </div>
    {{ Former::close() }}

@stop

@section('js')
    <script>
        // BV
        $("#bvForm").bootstrapValidator({
            fields: {
                group: {
                    validators: {
                        notEmpty: {}
                    }
                },
                branch: {
                    validators: {
                        notEmpty: {}
                    }
                }
            }
        });

    </script>
@stop