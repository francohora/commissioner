<?php
declare(strict_types=1);

namespace App\Services\IOService\Input;

use App\Services\IOService\DTO\CommissionResource;
use App\Services\IOService\Interfaces\InputInterface;

final class FileProcessor implements InputInterface
{
    private $rows = [];

    /**
     * @param string $input
     *
     * @return object[]
     *
     * @throws \Exception
     */
    public function getCommissionDetail(string $input): array
    {
        if (\file_exists($input) === false) {
            throw new \Exception('Not Existing');
        }

        foreach (\file($input, FILE_SKIP_EMPTY_LINES) as $row) {
            $detail = \json_decode($row, true);

            $dto = new CommissionResource();
            $dto->setAmount($detail['amount']);
            $dto->setBin($detail['bin']);
            $dto->setCurrency($detail['currency']);

            $this->rows[] = $dto;
        }

        return $this->rows;
    }
}
