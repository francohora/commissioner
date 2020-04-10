<?php
declare(strict_types=1);

namespace App\Services\IOService\DTO;

final class CommissionResource
{
    private $amount;

    private $bin;

    private $currency;

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setBin(string $bin): self
    {
        $this->bin = $bin;

        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }
}
