<?php declare(strict_types = 1);

namespace FractionFactory;

use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Model\Fraction;
use Algotech\Model\FractionFactory;
use Algotech\Model\MixedFraction;
use PHPUnit\Framework\TestCase;

/**
 * Test the createFraction method of the FractionFactory class
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class CreateFractionTest extends TestCase {
    /**
     * Denominator = 0 - throws ZeroDenominatorException
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testZeroDenominatorException(): void {
        $numerator = 15;
        $denominator = 0;

        $expectedException = new ZeroDenominatorException();
        $this->expectExceptionObject($expectedException);

        (new FractionFactory())->createFraction($numerator, $denominator);
    }

    /**
     * Numerator < denominator - create FractionObject
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsLowerThanDenominator(): void {
        $numerator = 5;
        $denominator = 10;

        $actual = (new FractionFactory())->createFraction($numerator, $denominator);
        $expected = new Fraction(1, 2, true);

        self::assertEquals($expected, $actual);
    }

    /**
     * Numerator equals denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorEqualsDenominator(): void {
        $numerator = 7;
        $denominator = 7;

        $actual = (new FractionFactory())->createFraction($numerator, $denominator);
        $expected = new MixedFraction(1);

        self::assertEquals($expected, $actual);
    }

    /**
     * Numerator is higher than denominator, numerator modulo denominator is zero
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsHigherDenominatorModuloIsZero(): void {
        $numerator = 42;
        $denominator = 7;

        $actual = (new FractionFactory())->createFraction($numerator, $denominator);
        $expected = new MixedFraction(6);

        self::assertEquals($expected, $actual);
    }

    /**
     * Numerator is higher than denominator, numerator modulo denominator is not zero
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testNumeratorIsHigherDenominatorModuloNotZero(): void {
        $numerator = 45;
        $denominator = 6;

        $actual = (new FractionFactory())->createFraction($numerator, $denominator);
        $expected = new MixedFraction(7, 1, 2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Denominator is zero - throws ZeroDenominatorException
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testDenominatorIsZero(): void {
        $numerator = 3;
        $denominator = 0;

        $expectedException = new ZeroDenominatorException();
        $this->expectExceptionObject($expectedException);

        (new FractionFactory())->createFraction($numerator, $denominator);
    }
}