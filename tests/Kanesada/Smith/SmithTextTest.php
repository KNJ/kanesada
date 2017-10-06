<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Exception\UndefinedMethodException;

final class SmithTextTest extends TestCase
{
    const INI_STR = 'Anything one man can imagine, other men can make real.';
    const REP_STR = 'Done is better than perfect.';

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

    public function testReplaceString()
    {
        $this->text->set(self::REP_STR);
        $this->assertSame(self::REP_STR, $this->text->get());

        return $this->text;
    }

    /**
     * @depends clone testReplaceString
     */
    public function testResetString(Text $text)
    {
        $text->reset();
        $this->assertSame(self::INI_STR, $text->get());
    }

    /**
     * @depends clone testReplaceString
     */
    public function testFlushString(Text $text)
    {
        $this->assertSame(self::REP_STR, $text->flush());
        $this->assertSame(self::INI_STR, $text->get());
    }

    public function testUndefinedMethod()
    {
        $this->expectException(UndefinedMethodException::class);
        $this->text->und();
    }
}
