<?php namespace Rabbit\Cpanel\Libraries;


use Rabbit\Cpanel\CurrencyModel;
use Rabbit\Cpanel\ExchangeModel;

class Currency
{
    private $khrUsd = 4000;
    private $usd = 1;
    private $khrThb = 100;
    private $thb = 1;

    /**
     * Rounding currency
     *
     * @param $currencyID
     * @param $amount
     * @return float
     */
    public function round($currencyID, $amount)
    {
        switch ($currencyID) {
            case 1: // KHR
                $rounding = 100;
                $amount = round($amount / $rounding) * $rounding;
                break;
            case 2: // USD
                $rounding = 2;
                $amount = round($amount, $rounding);
                break;
            case 3: // THB
                $rounding = 0;
                $amount = round($amount, $rounding);
                break;
        }
        return $amount;
    }

    /**
     * Format currency
     *
     * @param $currencyID
     * @param $amount
     * @return string
     */
    public function format($currencyID, $amount)
    {
        $name = CurrencyModel::find($currencyID)->name;
        $decPoint = explode('.', $amount);
        $decDigit = (isset($decPoint[1]) ? strlen($decPoint[1]) : 0);
        $amount = number_format($amount, $decDigit) . ' ' . $name;
        return $amount;
    }

    /**
     * Convert to Khr
     *
     * @param $currencyID
     * @param $amount
     * @param null $exchangeID
     * @param bool $round
     * @return float
     */
    public function toKHR($currencyID, $amount, $exchangeID = null, $round = false, $format = false)
    {
        $this->_setExchange($exchangeID);
        switch ($currencyID) {
            case 2:
                $amount = ($amount * $this->khrUsd) / $this->usd;
                break;
            case 3:
                $amount = ($amount * $this->khrThb) / $this->thb;
                break;
        }
        $amount = (($round == false) ? $amount : $this->round(1, $amount));
        $amount = (($format == false) ? $amount : $this->format(1, $amount));

        return $amount;
    }

    /**
     * Covert to USD
     *
     * @param $currencyID
     * @param $amount
     * @param null $exchangeID
     * @param bool $round
     * @return float
     */
    public function toUSD($currencyID, $amount, $exchangeID = null, $round = false, $format = false)
    {
        $this->_setExchange($exchangeID);
        switch ($currencyID) {
            case 1:
                $amount = ($amount * $this->usd) / $this->khrUsd;
                break;
            case 3:
                $amountKHR = ($amount * $this->khrThb) / $this->thb;
                $amount = ($amountKHR * $this->usd) / $this->khrUsd;
                break;
        }
        $amount = (($round == false) ? $amount : $this->round(2, $amount));
        $amount = (($format == false) ? $amount : $this->format(2, $amount));

        return $amount;
    }

    /**
     * Covert to Thb
     *
     * @param $currencyID
     * @param $amount
     * @param null $exchangeID
     * @param bool $round
     * @return float
     */
    public function toTHB($currencyID, $amount, $exchangeID = null, $round = false, $format = false)
    {
        $this->_setExchange($exchangeID);
        switch ($currencyID) {
            case 1:
                $amount = ($amount * $this->thb) / $this->khrThb;
                break;
            case 2:
                $amountKHR = ($amount * $this->khrUsd) / $this->usd;
                $amount = ($amountKHR * $this->thb) / $this->khrThb;
                break;
        }
        $amount = (($round == false) ? $amount : $this->round(3, $amount));
        $amount = (($format == false) ? $amount : $this->format(3, $amount));

        return $amount;
    }

    /**
     * Set exchange rate
     *
     * @param $exchangeID
     */
    private function _setExchange($exchangeID)
    {
        if (!is_null($exchangeID)) {
            $data = ExchangeModel::find($exchangeID);
            $this->khrUsd = $data->khr_usd;
            $this->usd = $data->usd;
            $this->khrThb = $data->khr_thb;
            $this->thb = $data->thb;
        }
    }

}