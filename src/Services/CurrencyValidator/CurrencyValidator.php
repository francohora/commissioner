<?php
declare(strict_types=1);

namespace App\CurrencyValidator;

use App\Interfaces\CurrencyValidatorInterface;

final class CurrencyValidator implements CurrencyValidatorInterface
{
    private $alphas;

    public function __construct(array $alphas)
    {
        $this->alphas = $alphas;
    }

    public function validate(string $currencyAlpha): bool
    {
        return \in_array($currencyAlpha, $this->alphas, true);
    }
}
