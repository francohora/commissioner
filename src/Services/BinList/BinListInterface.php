<?php
declare(strict_types=1);

namespace App\Services\BinList;

interface BinListInterface
{
    public function getAlpha(string $binCode): string;
}
