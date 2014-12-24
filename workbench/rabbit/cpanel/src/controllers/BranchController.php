<?php
namespace Rabbit\Cpanel;


use Rabbit\Cpanel\Requests\BranchRequest;

class BranchController extends BaseController
{

    protected $request;

    /**
     * @param BranchRequest $request
     */
    public function __construct(BranchRequest $request)
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
        return \View::make('cpanel::branch.index');
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
        $form->action = \URL::route('cpanel.branch.store');
        $form->method = 'post';
        $form->submit = 'Create';

        $data = new \EmptyClass();

        return \View::make('cpanel::branch.form', compact('form'), compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /staffs
     *
     * @return Response
     */
    public function store()
    {
        $data = new BranchModel();
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
        $form->action = \URL::route('cpanel.branch.update', $id);
        $form->method = 'put';
        $form->submit = 'Update';

        $data = BranchModel::find($id);

        return \View::make('cpanel::branch.form', compact('form'), compact('data'));
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
        $data = BranchModel::find($id);
        $this->_saveData($data);

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::route('cpanel.branch.index');
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
        $data = BranchModel::find($id);
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
     * @return mixed
     */
    public function validator()
    {
        return $this->request->validator();
    }

    /**
     * Save data
     *
     * @param $data
     */
    private function _saveData($data)
    {
        $id = \IDGenerator::make('cp_branch', 'id', '', 3);
        $inputs = (object)\Input::all();

        $data->id = $id;
        $data->kh_name = $inputs->kh_name;
        $data->kh_short_name = $inputs->kh_short_name;
        $data->en_name = $inputs->en_name;
        $data->en_short_name = $inputs->en_short_name;
        $data->kh_address = $inputs->kh_address;
        $data->en_address = $inputs->en_address;
        $data->telephone = $inputs->telephone;
        $data->email = $inputs->email;

        $data->save();
    }
}
