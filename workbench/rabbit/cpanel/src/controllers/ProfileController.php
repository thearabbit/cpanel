<?php
namespace Rabbit\Cpanel;

use Illuminate\Support\Facades\Auth;
use Rabbit\Cpanel\Requests\ProfileRequest;
use Rabbit\Cpanel\Validators\ProfileValidator;
use Rabbit\Cpanel\Validators\UserProfileValidator;

class ProfileController extends BaseController
{

    protected $request;

    /**
     * @param ProfileRequest $request
     */
    public function __construct(ProfileRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Edit profile
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $data['password_action'] = false;
        if (\Auth::user()->type == 'Super' or \Auth::user()->type == 'Admin') {
            $data['password_action'] = true;
        }

        $data['data'] = UserModel::find(\Auth::id());
        return \View::make('cpanel::profile.edit', $data);
    }

    /**
     * Update profile
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $data = UserModel::find(\Auth::id());
        $this->_saveData($data);

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::back();
    }

    /**
     * Save data
     *
     * @param $data
     */
    private function _saveData($data)
    {
        $inputs = (object)\Input::all();

        $data->full_name = $inputs->full_name;
        $data->email = $inputs->email;
        $data->username = $inputs->username;
        $data->password = \Hash::make($inputs->password);
        $data->password_action = $inputs->password_action;
        $data->save();
    }

    /**
     * Validator
     *
     * @return string
     */
    public function validator()
    {
        return $this->request->validator();
    }
}
