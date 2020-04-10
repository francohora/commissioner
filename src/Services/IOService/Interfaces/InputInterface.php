<?php
declare(strict_types=1);

namespace App\Services\IOService\Interfaces;

interface InputInterface
{
    /**
     * @param string $input
     *
     * @return array|void
     *
     * @throws \Exception
     */
    public function getCommissionDetail(string $input): array;
}
