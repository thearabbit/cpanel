<div class="navbar-right">
    <ul class="nav navbar-nav">
        <!-- Notifications: Refresh page (style can be found in dropdown.less) -->
        <li class="dropdown notifications-menu">
            <a href="{{ URL::current() }}" title="Refresh this page">
                <i class="fa fa-refresh"></i>
            </a>
        </li>
        <!-- Notifications: Open new windows (style can be found in dropdown.less) -->
        <li class="dropdown notifications-menu">
            <a href="{{ URL::current() }}" title="New tab" target="_blank">
                <i class="fa fa-plus"></i>
            </a>
        </li>
        <!-- Notifications: welcome page -->
        <li class="dropdown notifications-menu">
            <a href="{{ URL::route('cpanel.setting.create') }}" title="Setting page">
                <i class="fa fa-cogs"></i>
                {{ CpanelAuth::getBranch()->id . ' | ' . CpanelAuth::getBranch()->en_name }}
            </a>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" title="User profile" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i>
                <span>
                    {{ Auth::user()->full_name }}
                    <i class="caret"></i>
                </span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header bg-light-blue">
                    {{ HTML::image('assets/bower_components/adminlte/img/avatar5.png', 'User Image', array('class' => 'img-circle')) }}
                    <p>
                        {{ Auth::user()->full_name }} - {{ Auth::user()->type }}

                    <p>
                        <small>{{ Auth::user()->email }}</small>
                    </p>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{ URL::route('cpanel.profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ URL::route('cpanel.logout') }}" class="btn btn-default btn-flat">Log Out</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>