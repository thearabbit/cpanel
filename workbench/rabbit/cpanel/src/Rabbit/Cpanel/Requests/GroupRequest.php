<?php namespace Rabbit\Cpanel\Requests;

use Rabbit\Cpanel\GroupModel;

class GroupRequest
{

    /**
     * Get datatable
     *
     * @return mixed
     */
    public function datatable()
    {
        $data = GroupModel::orderBy('id', 'desc');
        // Check user type
        if (\Auth::user()->username != 'super') {
            $data->whereNotIn('name', ['Super', 'Admin']);
        }

        return \Datatable::query($data)
            ->showColumns('id', 'name', 'package')
            ->addColumn('permission', function ($model) {
                return implode(' | ', json_decode($model->permission));
            })
            ->addColumn(
                'action',
                function ($model) {
                    return \Action::make()
                        ->edit(\URL::route('cpanel.group.edit', $model->id))
                        ->delete(\URL::route('cpanel.group.destroy', $model->id), $model->id)
                        ->get();
                }
            )
            ->searchColumns('id', 'name', 'package', 'permission')
            ->orderColumns('id', 'name', 'package', 'permission')
            ->make();
    }

    /**
     * Validation
     *
     * @return string
     */
    public function validator()
    {
        $rules = [
            'name' => 'unique:cp_group,name,' . \Input::get('id'),
        ];

        $validator = \Validator::make(\Input::all(), $rules);
        $bvValid = $validator->passes();
        $bvMessage = implode('<br>', $validator->messages()->all());

        return json_encode(['valid' => $bvValid, 'message' => $bvMessage]);
    }

    /**
     * Package change
     *
     * @param $package
     * @return string
     */
    public function packageChange($package)
    {
        $permission = \Config::get($package . '::permission');
        $data = [];
        foreach ($permission as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $key2 => $val2) {
                    $data[] = ['id' => $key2, 'name' => $val2, 'group' => $key];
                }
            } else {
                $data[] = ['id' => $key, 'name' => $val];
            }
        }

        return json_encode($data);
    }

}