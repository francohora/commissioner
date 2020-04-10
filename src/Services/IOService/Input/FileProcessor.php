<?php
declare(strict_types=1);

namespace App\Services\IOService\Input;

use App\Services\IOService\Interfaces\InputInterface;

final class InputFileProcessor implements InputInterface
{
    /**
     * @param string $input
     *
     * @return string[]
     *
     * @throws \Exception
     */
    public function getCommissionDetail(string $input): array
    {
        if (\file_exists($input) === false) {
            throw new \Exception('Not Existing');
        }

        return \file($input, FILE_SKIP_EMPTY_LINES);
    }
}
