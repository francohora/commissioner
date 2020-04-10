<?php
declare(strict_types=1);

namespace App\Services\IOService\Output;

use App\Services\IOService\Interfaces\OutputInterface;

final class CliProcessor implements OutputInterface
{
    private $outputs = [];

    public function addOutput($data): void
    {
        $this->outputs[] = $data;
    }

    public function __toString()
    {
        return \implode("\n", $this->outputs);
    }
}
