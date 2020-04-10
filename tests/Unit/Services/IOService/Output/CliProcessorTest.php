<?php
declare(strict_types=1);

namespace Tests\Unit\Services\IOService\Output;

use App\Services\IOService\Output\CliProcessor;
use Tests\AbstractTestCase;

/**
 * @covers \App\Services\IOService\Output\CliProcessor
 */
final class CliProcessorTest extends AbstractTestCase
{
    public function testDisplay(): void
    {
        $output = new CliProcessor();
        $output->addOutput(1);

        self::assertEquals('', (string)$output);
    }
}
