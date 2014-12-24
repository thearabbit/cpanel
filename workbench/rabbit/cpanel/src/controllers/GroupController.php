<?php
namespace Rabbit\Cpanel;

use Rabbit\Cpanel\Requests\GroupRequest;
use Rabbit\Cpanel\Validators\GroupValidator;

class GroupController extends BaseController
{
    protected $request;

    /**
     * @param GroupRequest $request
     */
    public function __construct(GroupRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     * GET /branch
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('cpanel::group.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /staffs/create
     *
     * @return Response
     */
    public function create()
    {
        $form = new \stdClass();
        $form->action = \URL::route('cpanel.group.store');
        $form->method = 'post';
        $form->submit = 'Create';

        $data['form'] = $form;
        $data['data'] = new \EmptyClass();
        $data['permissions'] = json_encode([]);
        $data['permission'] = json_encode([]);

        return \View::make('cpanel::group.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * POST /staffs
     *
     * @return Response
     */
    public function store()
    {
        $data = new GroupModel();
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
        $form->action = \URL::route('cpanel.group.update', $id);
        $form->method = 'put';
        $form->submit = 'Update';

        $data = GroupModel::find($id);

        // Set permission selected
        $permission = [];
        foreach (json_decode($data->permission, true) as $val) {
            $permission[] = ['id' => $val];
        }
        $data['form'] = $form;
        $data['data'] = $data;
        $data['permissions'] = $this->request->packageChange($data->package);
        $data['permission'] = json_encode($permission);

        return \View::make('cpanel::group.form', $data);
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
        $data = GroupModel::find($id);
        $this->_saveData($data);

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::route('cpanel.group.index');
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
        $data = GroupModel::find($id);
        $data->delete();

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::back();
    }

    /**
     * Get datatable
     *
     * @return mixed
     */
    public function datatable()
    {
        return $this->request->datatable();
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

    /**
     * Package change
     *
     * @return mixed
     */
    public function packageChange()
    {
        return $this->request->packageChange(\Input::get('package'));
    }

    /**
     * Save data
     *
     * @param $data
     */
    private function _saveData($data)
    {
        $inputs = (object)\Input::all();

        $data->name = $inputs->name;
        $data->package = $inputs->package;
        $data->permission = json_encode($inputs->permission);

        $data->save();
    }

}
