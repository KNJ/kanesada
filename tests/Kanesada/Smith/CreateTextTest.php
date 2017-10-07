<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Validation\ValidationInterface;
use Wazly\Kanesada\Exception\InvalidFormatException;

final class CreateTextTest extends TestCase
{
    public function testCanBeCreatedFromString()
    {
        $this->assertInstanceOf(
            AlwaysValidText::class,
            AlwaysValidText::new('abcdef')
        );
    }

    public function testCannotBeCreatedIfInvalid()
    {
        $this->expectException(InvalidFormatException::class);
        AlwaysInvalidText::new('abcdef');
    }
}

class AlwaysValidText extends Text
{
    protected $validator = AlwaysValidValidation::class;
}

class AlwaysInvalidText extends Text
{
    protected $validator = AlwaysInvalidValidation::class;
}

class AlwaysValidValidation implements ValidationInterface
{
    public function isValid(string $text): bool
    {
        return true;
    }
}

class AlwaysInvalidValidation implements ValidationInterface
{
    public function isValid(string $text): bool
    {
        return false;
    }
}
