<?php namespace Rabbit\Cpanel\Requests;

use Rabbit\Cpanel\PostCommentModel;

class PostCommentRequest
{

    /**
     * Get datatable
     *
     * @return mixed
     */
    public function datatable()
    {
        $data = PostCommentModel::orderBy('id');

        return \Datatable::query($data)
            ->showColumns('id', 'title', 'body', 'post_date', 'type')
            ->addColumn(
                'action',
                function ($model) {
                    return \Action::make()
                        ->edit(\URL::route('cpanel.post_comment.edit', $model->id))
                        ->delete(\URL::route('cpanel.post_comment.destroy', $model->id), $model->id)
                        ->show(\URL::route('cpanel.post_comment.show', $model->id))->get();
                }
            )
            ->searchColumns('id', 'title', 'body', 'post_date', 'type')
            ->orderColumns('id', 'title', 'body', 'post_date', 'type')
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
            // 'field_name' => 'rules'
        ];

        $validator = \Validator::make(\Input::all(), $rules);
        $bvValid = $validator->passes();
        $bvMessage = implode('<br>', $validator->messages()->all());

        return json_encode(['valid' => $bvValid, 'message' => $bvMessage]);
    }
}
