<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Exception\StringNotFoundException;
use Wazly\Kanesada\Exception\UndefinedMethodException;

final class SmithTextTest extends TestCase
{
    const INI_STR = 'Anything one man can imagine, other men can make real.';
    const REP_STR = 'Done is better than perfect.';
    const MUL_STR = <<< EOL
12345
67891
01112
13141
51617
EOL;

    public function setUp()
    {
        $this->originalString = self::INI_STR;
        $this->text = Text::new($this->originalString);
    }

    public function testGetOriginalString()
    {
        $this->assertSame(self::INI_STR, $this->text->get());
    }

    public function testConvertToString()
    {
        $this->assertSame(self::INI_STR, (string) $this->text);
    }

    public function testSetString(): Text
    {
        $this->text->set(self::REP_STR);
        $this->assertSame(self::REP_STR, $this->text->get());

        return $this->text;
    }

    public function testPrependString()
    {
        $this->assertInstanceOf(
            Text::class,
            $this->text->prepend('1. ')
        );
        $this->assertSame(
            '1. Anything one man can imagine, other men can make real.',
            $this->text->get()
        );
    }

    public function testAppendString()
    {
        $this->assertInstanceOf(
            Text::class,
            $this->text->append('..')
        );
        $this->assertSame(
            'Anything one man can imagine, other men can make real...',
            $this->text->get()
        );
    }

    public function testReplaceOneWithOneString()
    {
        $this->assertInstanceOf(
            Text::class,
            $this->text->replace('can', 'will')
        );

        $this->assertSame(
            'Anything one man will imagine, other men will make real.',
            $this->text->get()
        );
    }

    public function testReplaceManyWithOneString()
    {
        $this->assertInstanceOf(
            Text::class,
            $this->text->replace(['man', 'men'], 'fish')
        );

        $this->assertSame(
            'Anything one fish can imagine, other fish can make real.',
            $this->text->get()
        );
    }

    public function testExplodeString()
    {
        $this->assertSame(
            ['Anything', 'one', 'man', 'can', 'imagine,', 'other', 'men', 'can', 'make', 'real.'],
            $this->text->explode(' ')
        );
    }

    public function testFindPosition()
    {
        $this->text->set(self::MUL_STR);
        $this->assertSame(
            [1, 1],
            $this->text->position('7')
        );
        $this->assertSame(
            [1, 3],
            $this->text->position('31')
        );
    }

    public function testFindNoPosition()
    {
        $this->expectException(StringNotFoundException::class);
        $this->text->position('pos');
    }

    public function testDeleteSingleLine()
    {
        $deleted = <<< EOL
12345
67891
13141
51617
EOL;
        $this->text->set(self::MUL_STR);
        $this->assertSame(
            $deleted,
            $this->text->deleteLine(2)->get()
        );
    }

    /**
     * @depends clone testSetString
     */
    public function testResetString(Text $text)
    {
        $text->reset();
        $this->assertSame(self::INI_STR, $text->get());
    }

    /**
     * @depends clone testSetString
     */
    public function testFlushString(Text $text)
    {
        $this->assertSame(self::REP_STR, $text->flush());
        $this->assertSame(self::INI_STR, $text->get());
    }

    public function testPrintln()
    {
        $this->text = StubText::new();
        ob_start();
        $this->text->println();
        $output = ob_get_clean();
        $this->assertSame(
            'dummy text'.PHP_EOL,
            $output
        );
    }

    public function testUndefinedMethod()
    {
        $this->expectException(UndefinedMethodException::class);
        $this->text->und();
    }
}

class StubText extends Text
{
    public function get(string $target = '', ...$args): string
    {
        return 'dummy text';
    }
}
