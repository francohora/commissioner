<?php
declare(strict_types=1);

namespace App\Services\IOService\Interfaces;

interface OutputInterface
{
    public function addOutput($data): void;
}
