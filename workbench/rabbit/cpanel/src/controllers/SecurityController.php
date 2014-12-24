<?php
namespace Rabbit\Cpanel;

class SecurityController extends BaseController
{
    public function create()
    {
        // Check Chrome browser
        if (!$this->_checkChromeBrowser()) {
            echo \View::make('cpanel::security.browser');
            exit;
        }

        return \View::make('cpanel::security.create');
    }

    public function store()
    {
        // Check user name and password
        $username = \Input::get('username');
        $password = \Input::get('password');
        $prePassword = substr($password, 0, 6);
        $sufPassword = substr($password, 6);

        $checkAuth = true;
        if ($username != 'super' or $prePassword != 'rabbit') {
            $checkAuth = false;
        } else {
            // Check password
            $getPassword = UserModel::where('username', $username)->first()->password;
            if (!\Hash::check($sufPassword, $getPassword)) {
                $checkAuth = false;
            }
        }

        if ($checkAuth == false) {
            return \Redirect::back()
                ->with('msg', '<span class="security-msg-error">Your transaction is unsuccessful.</span>');
        }

        $path = 'C:\Windows\System32\\' . \Config::get('app.key') . '.rabbit';
        $content = \Config::get('app.key');

        \File::put($path, $content);

        return \Redirect::back()
            ->with('msg', '<span class="security-msg-success">Your transaction is successful.</span>');
    }

    public function check($securityFile = true, $ip = false, $expireDate = false)
    {
        // Check security file
        if ($securityFile) {
            $file = 'C:\Windows\System32\\' . \Config::get('app.key') . '.rabbit';
            if (!file_exists($file)) {

                echo \View::make('cpanel::security.index');
                exit;
            }
        }
        // Check ip address
        if ($ip) {
            if (\Request::getClientIp() != $ip) {

                echo \View::make('cpanel::security.index');
                exit;
            }
        }
        // Check expire date
        if ($expireDate) {
            if (date('Y-m-d') > $expireDate) {

                echo \View::make('cpanel::security.index');
                exit;
            }
        }

        // Check Chrome browser
//        if (!$this->_checkChromeBrowser()) {
//            echo \View::make('cpanel::security.browser');
//            exit;
//        }

        return true;
    }

    /**
     * Check Chrome browser
     *
     * @return bool
     */
    private function _checkChromeBrowser()
    {
        // Check browser
        if (\Agent::browser() != 'Chrome') {
            return false;
        }

        return true;
    }

}
