<?php
namespace Rabbit\Cpanel;


use Rabbit\Cpanel\Requests\ExchangeRequest;

class ExchangeController extends BaseController
{

    protected $request;

    /**
     * @param BranchRequest $request
     */
    public function __construct(ExchangeRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     * GET /exchange
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('cpanel::exchange.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /exchange/create
     *
     * @return Response
     */
    public function create()
    {
        $form = new \stdClass();
        $form->action = \URL::route('cpanel.exchange.store');
        $form->method = 'post';
        $form->submit = 'Create';

        $exchange = new \EmptyClass();
        $exchange->exchange_date = date('Y-m-d');
        $data = $exchange;

        return \View::make('cpanel::exchange.form', compact('form'), compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /staffs
     *
     * @return Response
     */
    public function store()
    {
        $data = new ExchangeModel();
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
        $form->action = \URL::route('cpanel.exchange.update', $id);
        $form->method = 'put';
        $form->submit = 'Update';

        $data = ExchangeModel::find($id);

        return \View::make('cpanel::exchange.form', compact('form'), compact('data'));
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
        $data = ExchangeModel::find($id);
        $this->_saveData($data);

        \Notification::success(\Lang::get('cpanel::msg.success'));
        return \Redirect::route('cpanel.exchange.index');
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
        $data = ExchangeModel::find($id);
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
        $inputs = (object)\Input::all();

        $data->exchange_date = $inputs->exchange_date;
        $data->khr_usd = $inputs->khr_usd;
        $data->usd = $inputs->usd;
        $data->khr_thb = $inputs->khr_thb;
        $data->thb = $inputs->thb;
        $data->memo = $inputs->memo;
        $data->save();
    }
}
