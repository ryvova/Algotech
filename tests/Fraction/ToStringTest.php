<?php declare(strict_types = 1);

namespace Fraction;

use Algotech\Exceptions\InvalidFractionTypeException;
use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Model\Fraction;
use PHPUnit\Framework\TestCase;

/**
 * Tests for __toString method
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class ToStringTest extends TestCase {
    /**
     * Numerator is lower than denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsLowerThanDenominator(): void {
        $actual = (new Fraction(8, 10))->__toString();
        $expected = '4 / 5';

        self::assertSame($expected, $actual);
    }

    /**
     * Numerator equals denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorEqualsThanDenominator(): void {
        $expectedException = new InvalidFractionTypeException();
        $this->expectExceptionObject($expectedException);

        (new Fraction(4, 4))->__toString();
    }

    /**
     * Numerator is higher than denominator, greatest common divisor is higher than 1
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsHigherThanDenominatorGCDIsHigherThan1(): void {
        $expectedException = new InvalidFractionTypeException();
        $this->expectExceptionObject($expectedException);

        (new Fraction(10, 4))->__toString();
    }

    /**
     * Numerator is higher than denominator, greatest common divisor equals 1
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsHigherThanDenominatorGCDEquals1(): void {
        $expectedException = new InvalidFractionTypeException();
        $this->expectExceptionObject($expectedException);

        (new Fraction(19, 7))->__toString();
    }
}