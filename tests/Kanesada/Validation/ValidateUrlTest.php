<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Validation;

use PHPUnit\Framework\TestCase;

final class ValidateUrlTest extends TestCase
{
    public function setUp()
    {
        $this->validator = new UrlValidation;
    }

    public function testIsValid()
    {
        $this->assertTrue($this->validator->isValid('http://example.com'));
        $this->assertTrue($this->validator->isValid('https://example.com'));
        $this->assertTrue($this->validator->isValid('https://example.com/?foo=bar'));
    }

    public function testIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('ttp://example.com'));
        $this->assertFalse($this->validator->isValid('https://example.com?foo=bar'));
    }
}
