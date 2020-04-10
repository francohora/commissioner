<?php
declare(strict_types=1);

namespace Tests\Unit\Services\ExchangeRate;

use App\Services\ExchangeRate\ExchangeRate;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tests\AbstractTestCase;

/**
 * @covers \App\Services\ExchangeRate\ExchangeRate
 */
final class ExchangeRateTest extends AbstractTestCase
{
    public function testGetRate(): void
    {
        $sample = $this->getSampleRates();

        $stream = \Mockery::mock(StreamInterface::class);
        $stream->shouldReceive('getContents')
            ->once()
            ->andReturn(\json_encode($sample));

        $response = \Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getBody')->once()->andReturn($stream);

        $client = \Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')->once()->andReturn($response);

        $exchangeRate = new ExchangeRate($client, ['base_uri' => 'https://exchange-rate.com']);

        $rate = $exchangeRate->getRate('EUR');

        self::assertSame('0', $rate);
    }


    private function getSampleRates(): array
    {
        return [
            'rates' => [
                'CAD' => 1.5521,
                'HKD' => 8.50995,
                'ISK' => 154.0
            ],
            'base' => 'EUR',
            'date' => '2020-03-27'
        ];
    }
}
