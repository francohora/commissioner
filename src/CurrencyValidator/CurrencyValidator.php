<?php
declare(strict_types=1);

namespace App\CurrencyValidator;

use App\Interfaces\CurrencyValidatorInterface;

final class CurrencyValidator implements CurrencyValidatorInterface
{
    private $config;

    public function __construct()
    {
        $this->config = require_once 'config/accepted_alpha.php';
    }

    public function validate(string $currencyAlpha): bool
    {
        return \in_array($currencyAlpha, $this->config, true);
    }
}
