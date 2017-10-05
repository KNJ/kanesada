<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Validation;

use PHPUnit\Framework\TestCase;

final class ValidateTextTest extends TestCase
{
    public function setUp()
    {
        $this->validator = new TextValidation;
    }

    public function testIsValid()
    {
        $this->assertTrue($this->validator->isValid('dummy text'));
    }
}
