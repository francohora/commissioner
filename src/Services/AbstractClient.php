<?php
declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\ClientInterface;

abstract class AbstractClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    private $config;

    public function __construct(ClientInterface $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    public function request(string $method, string $endpoint)
    {
        $requestUri = \sprintf('%s%s', $this->config['base_uri'], $endpoint);

        return $this->client->request($method, $requestUri);
    }
}
