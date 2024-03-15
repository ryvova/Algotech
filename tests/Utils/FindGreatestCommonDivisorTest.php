<?php declare(strict_types = 1);

namespace tests\Utils;

use Algotech\Utils;
use PHPUnit\Framework\TestCase;

/**
 * A class for testing the findGreatesCommonDivisorTest method of class Utils
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class FindGreatestCommonDivisorTest extends TestCase
{
    /**
     * Number1 is lower than number2, positive numbers
     *
     * @return void
     */
    public function testNumber1IsLowerThanNumber2PositiveNumbers(): void
    {
        $number1 = 16;
        $number2 = 24;

        $actual = Utils::findGreatestCommonDivisor($number1, $number2);
        $expected = 8;

        self::assertSame($actual, $expected);
    }

    /**
     * Number1 is higher than number2, positive numbers
     *
     * @return void
     */
    public function testNumber1IsHigherThanNumber2PositiveNumbers(): void
    {
        $number1 = 24;
        $number2 = 16;

        $actual = Utils::findGreatestCommonDivisor($number1, $number2);
        $expected = 8;

        self::assertSame($actual, $expected);
    }

    /**
     * The greatest common divisor is 1, positive numbers
     *
     * @return void
     */
    public function testGreatesCommonDivisorIs1PositiveNumbers(): void
    {
        $number1 = 5;
        $number2 = 7;

        $actual = Utils::findGreatestCommonDivisor($number1, $number2);
        $expected = 1;

        self::assertSame($actual, $expected);
    }

    /**
     * Number1 is lower than number2, positive numbers
     *
     * @return void
     */
    public function testNumber1IsLowerThanNumber2NegativeNumbers(): void
    {
        $number1 = -60;
        $number2 = -40;

        $actual = Utils::findGreatestCommonDivisor($number1, $number2);
        $expected = 20;

        self::assertSame($actual, $expected);
    }

    /**
     * Number1 is higher than number2, positive numbers
     *
     * @return void
     */
    public function testNumber1IsHigherThanNumber2NegativeNumbers(): void
    {
        $number1 = -40;
        $number2 = -60;

        $actual = Utils::findGreatestCommonDivisor($number1, $number2);
        $expected = 20;

        self::assertSame($actual, $expected);
    }

    /**
     * The greatest common divisor is 1, negative numbers
     *
     * @return void
     */
    public function testGreatesCommonDivisorIs1NegativeNumbers(): void
    {
        $number1 = -19;
        $number2 = -23;

        $actual = Utils::findGreatestCommonDivisor($number1, $number2);
        $expected = 1;

        self::assertSame($actual, $expected);
    }
}