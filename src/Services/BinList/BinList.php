<?php
declare(strict_types=1);

namespace App\Services\BinList;

use App\Services\AbstractThirdParty;

final class BinList extends AbstractThirdParty implements BinListInterface
{
    private $binCache = [];

    public function __construct()
    {
        $config = require_once 'config/bin_list.php';

        parent::__construct($config);
    }

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
