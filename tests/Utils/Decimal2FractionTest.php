<?php declare(strict_types = 1);

namespace Utils;

use Algotech\Exceptions\InvalidFractionTypeException;
use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Model\Fraction;
use Algotech\Model\MixedFraction;
use Algotech\Utils;
use PHPUnit\Framework\TestCase;

/**
 * A class for testing the decimal2fraction method of class Utils
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class Decimal2FractionTest extends TestCase
{
    /**
     * Periodical decimal part one number (0.333333333...)
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testPeriodicalOneNumber(): void {
        $number = 1 / 3;

        $expected = new Fraction(1, 3, true);
        $actual = Utils::decimal2fraction($number);

        self::assertEquals($expected, $actual);
    }

    /**
     * Periodical decimal part two number (0.36363636...)
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testPeriodicalTwoNumber(): void {
        $number = 4 / 11;

        $expected = new Fraction(4, 11, true);
        $actual = Utils::decimal2fraction($number);

        self::assertEquals($expected, $actual);
    }

    /**
     * Periodical decimal part last number (1.833333333...)
     *
     * @return void
     * @throws ZeroDenominatorException
     * @throws InvalidFractionTypeException
     */
    public function testPeriodicalLastNumber(): void {
        $number = 11 / 6;

        $expected = new MixedFraction(1, 5, 6, true);
        $actual = Utils::decimal2fraction($number);

        self::assertEquals($expected, $actual);
    }

    /**
     * Periodical decimal part more numbers (0.857142857142857142...)
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testPeriodicalOneNumber2(): void {
        $number = 6 / 7;

        $expected = new Fraction(6, 7, true);
        $actual = Utils::decimal2fraction($number);

        self::assertEquals($expected, $actual);
    }

    /**
     * Without periodical repeat numbers
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testWithoutPeriodicalRepeat(): void {
        $number = 0.25;

        $expected = new Fraction(1, 4, true);
        $actual = Utils::decimal2fraction($number);

        self::assertEquals($expected, $actual);
    }
}