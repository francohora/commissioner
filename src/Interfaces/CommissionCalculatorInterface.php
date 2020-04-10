<?php
declare(strict_types=1);

namespace App\Interfaces;

interface CommissionCalculatorInterface
{
    public function calculate(string $input);
}
