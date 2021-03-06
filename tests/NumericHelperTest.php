<?php

namespace Yiisoft\Strings\Tests;

use PHPUnit\Framework\TestCase;
use Yiisoft\Strings\NumericHelper;

final class NumericHelperTest extends TestCase
{
    public function testToOrdinal(): void
    {
        $this->assertEquals('1st', NumericHelper::toOrdinal(1));
        $this->assertEquals('2nd', NumericHelper::toOrdinal(2));
        $this->assertEquals('3rd', NumericHelper::toOrdinal(3));
        $this->assertEquals('10th', NumericHelper::toOrdinal(10));
        $this->assertEquals('11th', NumericHelper::toOrdinal(11));
        $this->assertEquals('12th', NumericHelper::toOrdinal(12));
        $this->assertEquals('13th', NumericHelper::toOrdinal(13));
        $this->assertEquals('21st', NumericHelper::toOrdinal(21));
        $this->assertEquals('22nd', NumericHelper::toOrdinal(22));
        $this->assertEquals('23rd', NumericHelper::toOrdinal(23));
        $this->assertEquals('24th', NumericHelper::toOrdinal(24));
        $this->assertEquals('25th', NumericHelper::toOrdinal(25));
        $this->assertEquals('111th', NumericHelper::toOrdinal(111));
        $this->assertEquals('113th', NumericHelper::toOrdinal(113));

        $this->assertEquals('42nd', NumericHelper::toOrdinal('42'));
        $this->assertEquals('3.1415926', NumericHelper::toOrdinal('3.1415926'));
    }

    public function testToOrdinalWithIncorrectType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        NumericHelper::toOrdinal('bla-bla');
    }

    public function normalizeNumberDataProvider(): array
    {
        return [

            'French' => ['4 294 967 295,000', '4294967295.000'],
            'German' => ['4 294 967.295,000', '4294967295.000'],
            'Spanish' => ['4.294.967.295,000', '4294967295.000'],
            'English' => ['4,294,967,295.000', '4294967295.000'],
            'Smaller' => ['10,111', '10.111'],
        ];
    }

    /**
     * @dataProvider normalizeNumberDataProvider
     */
    public function testNormalizeNumber(string $input, string $expected): void
    {
        $this->assertSame($expected, NumericHelper::normalize($input));
    }

    public function testNormalizeNumberWithIncorrectType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        NumericHelper::normalize([]);
    }
}
