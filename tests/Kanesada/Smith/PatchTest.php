<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Patch\RuleInterface;

final class PatchTest extends TestCase
{
    public function testCallPatch()
    {
        $text1 = StubTextForPatch::new('dummy text');
        $this->assertSame(
            'updated dummy text',
            $text1->apply('dummy_rule')->get()
        );

        $text2 = StubTextForPatch::new('dummy text');
        $this->assertSame(
            'dummy text was updated',
            $text2->applyDummyRule()->get()
        );
    }
}

class StubTextForPatch extends Text
{
    protected $patchRule = StubRule::class;
}

class StubRule implements RuleInterface
{
    public function apply(string $text, ...$rules): string
    {
        return 'updated dummy text';
    }

    public function applyDummyRule(): string
    {
        return 'dummy text was updated';
    }
}
