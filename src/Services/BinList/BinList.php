<?php
declare(strict_types=1);

namespace App\Services\BinList;

use App\Services\AbstractClient;

final class BinList extends AbstractClient implements BinListInterface
{
    private $binCache = [];

    public function getAlpha(string $binCode): string
    {
        if (\array_key_exists($binCode, $this->binCache) === false) {
            $result = $this->request('GET', $binCode);

            $this->binCache[$binCode] = $result->getBody()->getContents();
        }

        $content = \json_decode($this->binCache[$binCode], true);

        return $content['country']['alpha2'];
    }
}
