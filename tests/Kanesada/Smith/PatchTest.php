<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Patch\RuleInterface;

final class PatchTest extends TestCase
{
    public function testCallPatch()
    {
        $text = StubText::new('dummy text');
        $this->assertSame(
            'updated dummy text',
            $text->apply('dummy_rule')->dump()
        );
    }
}

class StubText extends Text
{
    protected $patchRule = StubRule::class;
}

class StubRule implements RuleInterface
{
    public function apply(string $text, ...$rules): string
    {
        return 'updated dummy text';
    }
}
