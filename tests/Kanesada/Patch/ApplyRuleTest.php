<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Patch;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Exception\UndefinedMethodException;

final class ApplyRuleTest extends TestCase
{
    public function setUp()
    {
        $this->patch = new TextRule;
    }

    public function testApplyNoSpacesRule()
    {
        $this->assertSame(
            'Allspacesareremoved.',
            $this->patch->apply(' All spaces  are   removed. ', 'no_spaces')
        );

        // applyXxxx
        $this->assertSame(
            'Allspacesareremoved.',
            $this->patch->applyNoSpaces(' All spaces  are   removed. ')
        );
    }

    public function testApplyTrimRule()
    {
        $this->assertSame(
            "This sentence is\ttrimmed.",
            $this->patch->apply("\t This sentence is\ttrimmed.\n ", 'trim')
        );

        // applyXxxx
        $this->assertSame(
            "This sentence is\ttrimmed.",
            $this->patch->applyTrim("\t This sentence is\ttrimmed.\n ")
        );
    }

    public function testApplyTrimeRuleWithArgs()
    {
        $this->assertSame(
            "\t This sentence is\ttrimmed.\n",
            $this->patch->applyTrim("\t This sentence is\ttrimmed.\n ", ' ')
        );
    }

    public function testApplyAnonymousRule()
    {
        $this->assertSame(
            "This sentence is\ttrimmed.",
            $this->patch->apply("\t This sentence is\ttrimmed.\n ", function ($text) {
                return trim($text);
            })
        );
    }

    public function testApplyUndefinedRule()
    {
        $this->expectException(UndefinedMethodException::class);
        $this->patch->applyFoo('bar');
    }
}
