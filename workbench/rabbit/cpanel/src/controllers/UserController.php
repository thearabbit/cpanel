<?php
namespace Rabbit\Cpanel;

use Illuminate\Support\Facades\Auth;
use Rabbit\Cpanel\Requests\UserRequest;

class UserController extends BaseController
{

    protected $request;

    /**
     * @param UserRequest $request
     */
    public function __construct(UserRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     * GET /user
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('cpanel::user.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /user/create
     *
     * @return Response
     */
    public function create()
    {
        $form = new \stdClass();
        $form->action = \URL::route('cpanel.user.store');
        $form->method = 'post';
        $form->submit = 'Create';

        $data['form'] = $form;
        $data['data'] = new \EmptyClass();

        return \View::make('cpanel::user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * POST /user
     *
     * @return Response
     */
    public function store()
    {
        $data = new UserModel();
        $this->_saveData($data);

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::back();
    }

    /**
     * Display the specified resource.
     * GET /staffs/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /staffs/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $form = new \stdClass();
        $form->action = \URL::route('cpanel.user.update', $id);
        $form->method = 'put';
        $form->submit = 'Update';

        $data['form'] = $form;
        $data['data'] = UserModel::find($id);

        return \View::make('cpanel::user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * PUT /staffs/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $data = UserModel::find($id);
        $this->_saveData($data, 'edit');

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::route('cpanel.user.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /staffs/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = UserModel::find($id);
        $data->delete();

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::back();
    }

    /**
     * Get data table
     *
     * @return mixed
     */
    public function datatable()
    {
        return $this->request->datatable();
    }

    /**
     * Save data
     *
     * @param $data
     */
    private function _saveData($data, $action = 'create')
    {
        $id = \IDGenerator::make('cp_user', 'id', '', 3);
        $inputs = (object)\Input::all();

        if ($action == 'create') $data->id = $id;
        $data->full_name = $inputs->full_name;
        $data->email = $inputs->email;
        $data->type = $inputs->type;
        $data->group = json_encode($inputs->group);
        $data->branch = json_encode($inputs->branch);
        $data->username = $inputs->username;
        $data->password = \Hash::make($inputs->password);
        $data->password_action = $inputs->password_action;
        $data->activated = $inputs->activated;
        $data->owner_id = \Auth::id();
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
