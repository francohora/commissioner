<?php
declare(strict_types=1);

namespace App\Services\ExchangeRate;

use App\Services\AbstractClient;

final class ExchangeRate extends AbstractClient implements ExchangeRateInterface
{
    private $cacheRate = ['EUR' => '0'];

    public function getRate(string $currency): string
    {
        if (array_key_exists($currency, $this->cacheRate) === false) {
            $exchangeRate = $this->request('GET', 'latest');

            $rates  = \json_decode($exchangeRate->getBody()->getContents(), true);

            // cache the rate
            $this->cacheRate += $rates['rates'];
        }

        return (string)$this->cacheRate[$currency];
    }
}
