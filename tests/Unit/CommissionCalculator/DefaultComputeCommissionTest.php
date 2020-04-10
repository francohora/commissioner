<?php
declare(strict_types=1);

namespace Tests\Unit\CommissionCalculator;

use App\CommissionCalculator\DefaultComputeCommission;
use App\Services\CurrencyValidator\CurrencyValidatorInterface;
use Tests\AbstractTestCase;

/** 
 * @covers \App\CommissionCalculator\DefaultComputeCommission 
 */
final class DefaultComputeCommissionTest extends AbstractTestCase
{
    public function testComputeWithNonEuCurrency(): void
    {
        $validator = \Mockery::mock(CurrencyValidatorInterface::class);
        $validator->shouldReceive('validate')->once()->andReturn(false);

        $defaultCompute = new DefaultComputeCommission($validator, ['eu' => 1, 'non_eu' => 2]);
        $result = $defaultCompute->compute('100', '1', 'JPY');

        self::assertEquals(200, $result);
    }

    public function testComputeInEu(): void
    {
        $validator = \Mockery::mock(CurrencyValidatorInterface::class);
        $validator->shouldReceive('validate')->once()->andReturn(true);

        $defaultCompute = new DefaultComputeCommission($validator, ['eu' => 1, 'non_eu' => 2]);
        $result = $defaultCompute->compute('100', '0', 'EUR');

        self::assertEquals(100, $result);
    }
}
