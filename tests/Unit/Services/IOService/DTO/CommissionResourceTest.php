<?php
declare(strict_types=1);

namespace Tests\Unit\Services\IOService\DTO;

use App\Services\IOService\DTO\CommissionResource;
use Tests\AbstractTestCase;

final class CommissionResourceTest extends AbstractTestCase
{
    public function testSetterAndGetters(): void
    {
        $resource = new CommissionResource();

        self::assertEquals('123456', $resource->setBin('123456')->getBin());
        self::assertEquals('100.00', $resource->setAmount('100.00')->getAmount());
        self::assertEquals('EUR', $resource->setCurrency('EUR')->getCurrency());
    }
}
