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

    public function testHasWhiteSpaces()
    {
        $this->assertTrue($this->validator->hasWhiteSpaces('This sentence contains a space.'));
        $this->assertTrue($this->validator->hasWhiteSpaces("This sentence contains a\ttab."));
        $this->assertTrue($this->validator->hasWhiteSpaces("This sentence contains a\nnewline."));
        $this->assertFalse($this->validator->hasWhiteSpaces('Thissentencecontainsnowhitespaces.'));
    }

    public function testHasWhiteLeadingSpace()
    {
        $this->assertTrue($this->validator->hasLeadingWhiteSpace(' This sentence has a leading white space.'));
        $this->assertFalse($this->validator->hasLeadingWhiteSpace('This sentence has a trailing white space. '));
    }

    public function testHasTrailingWhiteSpace()
    {
        $this->assertFalse($this->validator->hasTrailingWhiteSpace(' This sentence has a leading white space.'));
        $this->assertTrue($this->validator->hasTrailingWhiteSpace('This sentence has a trailing white space. '));
    }
}
