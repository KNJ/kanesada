<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Patch;

use PHPUnit\Framework\TestCase;

final class ApplyRuleTest extends TestCase
{
    public function setUp()
    {
        $this->patch = new DefaultTextRule;
    }

    public function testApplyNoSpacesRule()
    {
        $this->assertSame(
            'Allspacesareremoved.',
            $this->patch->apply(' All spaces  are   removed. ', 'no_spaces')
        );
    }

    public function testApplyTrimRule()
    {
        $this->assertSame(
            "This sentence is\ttrimmed.",
            $this->patch->apply("\t This sentence is\ttrimmed.\n ", 'trim')
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
}
