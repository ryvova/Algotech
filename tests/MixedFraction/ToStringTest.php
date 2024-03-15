<?php declare(strict_types = 1);

namespace MixedFraction;

use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Model\MixedFraction;
use PHPUnit\Framework\TestCase;

/**
 * Tests for __toString method
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class ToStringTest extends TestCase {
    /**
     * Numerator equals denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorEqualsDenominator(): void {
        $numerator = 3;
        $denominator = 3;

        $expected = "1";
        $actual = (new MixedFraction(null, $numerator, $denominator))->__toString();

        self::assertEquals($expected, $actual);
    }

    /**
     * Numerator is higher than denominator, numerator modulo denominator is zero
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsHigherThanDenominatorModuloIsZero(): void {
        $numerator = 8;
        $denominator = 4;

        $expected = "2";
        $actual = (new MixedFraction(null, $numerator, $denominator))->__toString();

        self::assertEquals($expected, $actual);
    }

    /**
     * Numerator is higher than denominator, numerator modulo denominator is not zero
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testHasWholePartAndFraction(): void {
        $numerator = 14;
        $denominator = 4;

        $expected = "3 1/2";
        $actual = (new MixedFraction(null, $numerator, $denominator))->__toString();

        self::assertEquals($expected, $actual);
    }
}