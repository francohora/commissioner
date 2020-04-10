<?php
declare(strict_types=1);

namespace Tests\Unit\Services\BinList;

use App\Services\BinList\BinList;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tests\AbstractTestCase;

/**
 * @covers \App\Services\BinList\BinList
 */
final class BinListTest extends AbstractTestCase
{
    public function testGetAlpha()
    {
        $sample = $this->sampleReturn();

        $stream = \Mockery::mock(StreamInterface::class);
        $stream->shouldReceive('getContents')
            ->once()
            ->andReturn(\json_encode($sample));

        $response = \Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($stream);

        $client = \Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')
            ->once()
            ->andReturn($response);

        $binList = new BinList($client, ['base_uri' => 'https://bin-list.com']);

        $result = $binList->getAlpha('123456');

        self::assertSame($sample['country']['alpha2'], $result);
    }

    private function sampleReturn(): array
    {
        return [
            'number' => [
                'length' => 16,
                'luhn' => true
            ],
            'scheme' => 'visa',
            'type' => 'debit',
            'brand' => 'Visa/Dankort',
            'prepaid' => false,
            'country' => [
                'numeric' => 208,
                'alpha2' => 'DK',
                'name' => 'Denmark',
                'emoji' => '🇩🇰',
                'currency' => 'DKK',
                'latitude' => 56,
                'longitude' => 10
            ],
            'bank' => [
                'name' => 'Jyske Bank',
                'url' => 'www.jyskebank.dk',
                'phone' => '+4589893300',
                'city' => 'Hjørring'
            ]
        ];
    }
}
