<?php
declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

abstract class AbstractThirdParty
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function __construct(array $config)
    {
        $this->client = new Client($config);
    }

    public function request(string $method, string $endpoint)
    {
        return $this->client->request($method, $endpoint);
    }
}
