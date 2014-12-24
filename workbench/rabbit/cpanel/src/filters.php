<?php

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application.
|
*/

Route::filter('auth.cpanel', function () {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::route('cpanel.get_login');
        }
    }
});


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest.cpanel', function () {
    if (Auth::check()) {
        return Redirect::route('cpanel.setting.create');
    }
});

/*
|--------------------------------------------------------------------------
| Group Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session has group.
|
*/

Route::filter('setting.cpanel', function () {
    if (!CpanelAuth::has()) {
        \Notification::error(\Lang::get('cpanel::msg.setting'));
        return Redirect::route('cpanel.setting.create');
    }
});


/*
|--------------------------------------------------------------------------
| Permission Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| permission is permitted into this application.
|
*/

Route::filter('permission.cpanel', function () {
    // Check user type
    if (Auth::user()->type != 'Super') {
        $routeOriginalName = Route::current()->getName();
        list($prefix, $resource, $action) = explode('.', $routeOriginalName);

        switch ($action) {
            case 'show':
                $routeName = $prefix . '.' . $resource . '.index';
                break;
            case 'store':
                $routeName = $prefix . '.' . $resource . '.create';
                break;
            case 'update':
                $routeName = $prefix . '.' . $resource . '.edit';
                break;
            default:
                $routeName = $routeOriginalName;
                break;
        }

        $permission = json_decode(CpanelAuth::getGroup()->permission, true);
        $filter = in_array($routeName, $permission);

        if ($filter == false) {
            \Notification::error(\Lang::get('cpanel::msg.permission'));
            return Redirect::back();
        }
    }
});
