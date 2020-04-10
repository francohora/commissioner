<?php
declare(strict_types=1);

namespace Tests\Unit\Services\IOService\Input;

use App\Services\IOService\DTO\CommissionResource;
use App\Services\IOService\Input\FileProcessor;
use Tests\AbstractTestCase;

/**
 * @covers \App\Services\IOService\Input\FileProcessor
 */
final class FileProcessorTest extends AbstractTestCase
{
    public function testGetCommissionDetailShouldThrowException(): void
    {
        $this->expectException(\Exception::class);

        (new FileProcessor())->getCommissionDetail('not-existing-file.txt');
    }

    public function testGetCommissionDetail(): void
    {
        $sample = ['bin' => '123456', 'amount' => '100', 'currency' => 'EUR'];

        \file_put_contents('sample.txt', \json_encode($sample));

        $result = (new FileProcessor())->getCommissionDetail('sample.txt');

        self::assertCount(1, $result);
        foreach ($result as $row) {
            self::assertInstanceOf(CommissionResource::class, $row);
        }

        unlink('sample.txt');
    }
}
