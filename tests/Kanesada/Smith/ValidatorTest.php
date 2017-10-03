<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Validation\ValidationInterface;

final class ValidatorTest extends TestCase
{
    public function testCallValidator()
    {
        $text = StubTextForValidation::new('dummy text');
        $this->assertSame(
            true,
            $text->validate()
        );
    }
}

class StubTextForValidation extends Text
{
    protected $validator = StubValidation::class;
}

class StubValidation implements ValidationInterface
{
    public function isValid(string $text): bool
    {
        return true;
    }
}
