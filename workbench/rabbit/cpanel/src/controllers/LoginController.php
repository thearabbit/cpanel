<?php namespace Rabbit\Cpanel;

class LoginController extends BaseController
{

    /**
     * Get login form
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        // Check security file, ip and expire date
        $security = new \Rabbit\Cpanel\SecurityController();
        $security->check(true, false, false);

        return \View::make('cpanel::login.form');
    }

    /**
     * Post login form
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $username = \Input::get('username');
        $password = \Input::get('password');
        $prePassword = 'rtc';

        if ($username == 'super') {
            $prePassword = substr($password, 0, 3);
            $password = substr(\Input::get('password'), 3);
        }

        if ($prePassword == 'rtc') {
            $validator = array(
                'username' => $username,
                'password' => $password,
                'activated' => 'Yes',
            );
            if (\Auth::attempt($validator)) {
                return \Redirect::route('cpanel.setting.create');
            }
        }

        \Notification::error(\Lang::get('cpanel::msg.login'));
        return \Redirect::back();
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if (\Auth::check()) {

            // Clear auth group and branch session
            \CpanelAuth::clear();

            \Auth::logout();

//            \Notification::success(\Lang::get('cpanel::msg.logout'));
            return \Redirect::route('cpanel.get_login');
        }
    }

}