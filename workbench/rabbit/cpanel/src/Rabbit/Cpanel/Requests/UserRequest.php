<?php
namespace Rabbit\Cpanel\Requests;

use Rabbit\Cpanel\UserModel;

class UserRequest
{

    /**
     * Get data table
     *
     * @return mixed
     */
    public function datatable()
    {
        $user = \Auth::user();
        $data = UserModel::orderBy('id', 'desc');
        if ($user->type == 'Admin') {
            $data->where('owner_id', $user->id);
        }
        return \Datatable::query($data)
            ->showColumns('id', 'full_name', 'email', 'type', 'activated')
            ->addColumn('group', function ($model) {
                return implode(' | ', json_decode($model->group));
            })
            ->addColumn('branch', function ($model) {
                return implode(' | ', json_decode($model->branch));
            })
            ->showColumns('username', 'owner_id')
            ->addColumn(
                'action',
                function ($model) {
                    return \Action::make()
                        ->edit(\URL::route('cpanel.user.edit', $model->id))
                        ->delete(\URL::route('cpanel.user.destroy', $model->id), $model->id)
                        ->get();
                }
            )
            ->searchColumns('id', 'full_name', 'email', 'type', 'active', 'username', 'owner_id')
            ->orderColumns('id', 'full_name', 'email', 'type', 'active', 'username', 'owner_id')
            ->make();
    }

    public function validator()
    {
        $rules = [
            'email' => 'unique:cp_user,email,' . \Input::get('id'),
            'username' => 'unique:cp_user,username,' . \Input::get('id'),
            'password' => 'alpha_and_num',
            'password_action' => 'alpha_and_num',
        ];
        $messages = [
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
