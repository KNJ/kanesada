<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Validation;

use PHPUnit\Framework\TestCase;

final class ValidateWordTest extends TestCase
{
    public function setUp()
    {
        //
    }

    public function testIsValid()
    {
        $validator = new class extends WordValidation {
            public function hasWhiteSpaces(string $text): bool
            {
                return false;
            }
        };

        $this->assertTrue($validator->isValid('dummy'));
    }

    public function testIsNotValid()
    {
        $validator = new class extends WordValidation {
            public function hasWhiteSpaces(string $text): bool
            {
                return true;
            }
        };

        $this->assertFalse($validator->isValid('dummy'));
    }
}
