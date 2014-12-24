<?php
namespace Rabbit\Cpanel\Requests;


class ProfileRequest
{

    /**
     * Validator
     *
     * @return string
     */
    public function validator()
    {
        $rules = [
            'email' => 'unique:cp_user,email,' . \Input::get('id'),
            'username' => 'unique:cp_user,username,' . \Input::get('id'),
            'password_old' => 'password_old',
            'password' => 'alpha_and_num',
            'password_action' => 'alpha_and_num',
        ];
        $messages = [
            'password_old' => 'The old password is invalid.',
            'alpha_and_num' => 'The :attribute must be contain letters and numeric.',
        ];
        $validator = \Validator::make(\Input::all(), $rules, $messages);
        $bvValid = $validator->passes();
        $bvMessage = implode('<br>', $validator->messages()->all());

        return json_encode(['valid' => $bvValid, 'message' => $bvMessage]);
    }

}

/*******************************
 * Customer Validation Rules
 ******************************/
// Password contain letter and numeric
\Validator::extend('alpha_and_num', function ($attribute, $value, $parameters) {
    if (!preg_match('/[0-9]+/', $value)) {
        return false;
    }

    if (!preg_match('/[a-zA-Z]+/', $value)) {
        return false;
    }

    return true;
});
// Verify old password
\Validator::extend('password_old', function ($attribute, $value, $parameters) {
    if (\Hash::check($value, \Auth::user()->password)) {
        return true;
    }

    return false;
});
