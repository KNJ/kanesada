<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Validation;

use PHPUnit\Framework\TestCase;

final class ValidateSentenceTest extends TestCase
{
    public function setUp()
    {
        //
    }

    public function testIsValid()
    {
        $validator = new class extends SentenceValidation {
            public function hasLeadingWhiteSpace(string $text): bool
            {
                return false;
            }

            public function hasTrailingWhiteSpace(string $text): bool
            {
                return false;
            }
        };

        $this->assertTrue($validator->isValid('dummy'));
    }

    public function testIsNotValid()
    {
        $validator1 = new class extends SentenceValidation {
            public function hasLeadingWhiteSpace(string $text): bool
            {
                return true;
            }

            public function hasTrailingWhiteSpace(string $text): bool
            {
                return false;
            }
        };

        $this->assertFalse($validator1->isValid('dummy'));

        $validator2 = new class extends SentenceValidation {
            public function hasLeadingWhiteSpace(string $text): bool
            {
                return false;
            }

            public function hasTrailingWhiteSpace(string $text): bool
            {
                return true;
            }
        };

        $this->assertFalse($validator2->isValid('dummy'));

        $validator3 = new class extends SentenceValidation {
            public function hasLeadingWhiteSpace(string $text): bool
            {
                return true;
            }

            public function hasTrailingWhiteSpace(string $text): bool
            {
                return true;
            }
        };

        $this->assertFalse($validator3->isValid('dummy'));
    }
}
