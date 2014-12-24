<?php
namespace Rabbit\Cpanel\Requests;

use Rabbit\Cpanel\BranchModel;
class BranchRequest
{

    /**
     * Get data table
     *
     * @return mixed
     */
    public function datatable()
    {
        $data = BranchModel::orderBy('id', 'desc');

        return \Datatable::query($data)
            ->showColumns('id', 'kh_name', 'kh_short_name', 'en_name', 'en_short_name', 'telephone')
            ->addColumn(
                'action',
                function ($model) {
                    return \Action::make()
                        ->edit(\URL::route('cpanel.branch.edit', $model->id))
                        ->delete(\URL::route('cpanel.branch.destroy', $model->id), $model->id)
                        ->get();
                }
            )
            ->searchColumns('id', 'kh_name', 'kh_short_name', 'en_name', 'en_short_name', 'telephone')
            ->orderColumns('id', 'kh_name', 'kh_short_name', 'en_name', 'en_short_name', 'telephone')
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
            'kh_name' => 'unique:cp_branch,kh_name,' . \Input::get('id'),
            'kh_short_name' => 'unique:cp_branch,kh_short_name,' . \Input::get('id'),
            'en_name' => 'unique:cp_branch,en_name,' . \Input::get('id'),
            'en_short_name' => 'unique:cp_branch,en_short_name,' . \Input::get('id'),
        ];

        $validator = \Validator::make(\Input::all(), $rules);
        $bvValid = $validator->passes();
        $bvMessage = implode('<br>', $validator->messages()->all());

        return json_encode(['valid' => $bvValid, 'message' => $bvMessage]);
    }

}
