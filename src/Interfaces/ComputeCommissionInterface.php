<?php
declare(strict_types=1);

namespace App\Interfaces;

interface ComputeCommissionInterface
{
    public function compute(string $amount, string $rate, string $alpha): string;
}
