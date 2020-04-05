<?php
declare(strict_types=1);

namespace App\Services\ExchangeRate;

use App\Services\AbstractThirdParty;

final class ExchangeRate extends AbstractThirdParty implements ExchangeRateInterface
{
    private $cacheRate = ['EUR' => '0'];

    private $config;

    public function __construct()
    {
        $this->config = require_once 'config/exchange_rate.php';

        parent::__construct($this->config);
    }

    public function getRate(string $currency): string
    {
        if (array_key_exists($currency, $this->cacheRate) === false) {
            $exchangeRate = $this->request('GET', $this->config['rate_type']);

            $rates  = \json_decode($exchangeRate->getBody()->getContents(), true);

            // cache the rate
            $this->cacheRate += $rates['rates'];
        }

        return (string)$this->cacheRate[$currency];
    }
}
