<?php
declare(strict_types=1);

namespace Tests\Unit\Services\CurrencyValidator;

use App\Services\CurrencyValidator\CurrencyValidator;
use Tests\AbstractTestCase;

/**
 * @covers \App\Services\CurrencyValidator\CurrencyValidator
 */
final class CurrencyValidatorTest extends AbstractTestCase
{
    public function testValidate(): void
    {
        $alpha = ['EUR', 'DK'];

        $validator  = new CurrencyValidator($alpha);

        self::assertTrue($validator->validate('EUR'));
    }
}
