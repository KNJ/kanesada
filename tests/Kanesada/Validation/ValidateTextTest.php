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

    public function testHasLeadingSpace()
    {
        $this->assertTrue($this->validator->hasLeadingSpace(' This sentence has a leading space.'));
        $this->assertFalse($this->validator->hasLeadingSpace('This sentence has a trailing space. '));
    }

    public function testHasTrailingSpace()
    {
        $this->assertFalse($this->validator->hasTrailingSpace(' This sentence has a leading space.'));
        $this->assertTrue($this->validator->hasTrailingSpace('This sentence has a trailing space. '));
    }
}
