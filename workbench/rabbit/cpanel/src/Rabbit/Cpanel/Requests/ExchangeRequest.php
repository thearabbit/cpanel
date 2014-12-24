<?php
namespace Rabbit\Cpanel\Requests;

use Rabbit\Cpanel\ExchangeModel;

class ExchangeRequest
{

    /**
     * Get data table
     *
     * @return mixed
     */
    public function datatable()
    {
        $data = ExchangeModel::orderBy('exchange_date', 'desc');

        return \Datatable::query($data)
            ->showColumns('exchange_date', 'khr_usd', 'usd', 'khr_thb', 'thb', 'memo')
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(\URL::route('cpanel.exchange.edit', $model->id))
                    ->delete(\URL::route('cpanel.exchange.destroy', $model->id), $model->id)
                    ->get();
            })
            ->searchColumns('exchange_date')
            ->orderColumns('exchange_date')
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
            'exchange_date' => 'unique:cp_exchange,exchange_date,' . \Input::get('id'),
        ];

        $validator = \Validator::make(\Input::all(), $rules);
        $bvValid = $validator->passes();
        $bvMessage = implode('<br>', $validator->messages()->all());

        return json_encode(['valid' => $bvValid, 'message' => $bvMessage]);
    }

}
