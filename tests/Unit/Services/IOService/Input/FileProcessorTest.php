<?php
declare(strict_types=1);

namespace Tests\Unit\Services\IOService\Input;

use App\Services\IOService\Input\InputFileProcessor;
use Tests\AbstractTestCase;

/**
 * @covers \App\Services\IOService\Input\InputFileProcessor
 */
final class InputFileProcessorTest extends AbstractTestCase
{
    public function testGetCommissionDetailShouldThrowException(): void
    {
        $this->expectException(\Exception::class);

        (new InputFileProcessor())->getCommissionDetail('not-existing-file.txt');
    }

    public function testGetCommissionDetail(): void
    {
        $sample = ['sample' => 'sample'];

        \file_put_contents('sample.txt', \json_encode($sample));

        $result = (new InputFileProcessor())->getCommissionDetail('sample.txt');

        self::assertCount(1, $result);
        foreach ($result as $row) {
            self::assertSame($sample, \json_decode($row, true));
        }

        unlink('sample.txt');
    }
}
