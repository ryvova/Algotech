<?php declare(strict_types = 1);

namespace Operation;

use Algotech\Exceptions\InvalidFractionTypeException;
use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Model\Fraction;
use Algotech\Model\MixedFraction;
use Algotech\Operation;
use PHPUnit\Framework\TestCase;

/**
 * A class for testing the multiply method of class Operation
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class MultiplyTest extends TestCase {
    private static Operation $operation;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Inicialization - run 1 time before all tests
     *
     * @return void
     */
    public static function setUpBeforeClass(): void {
        parent::setUpBeforeClass();

        self::$operation = Operation::getInstance();
    }

    /**
     * Both params are int
     *
     * @return void
     * @throws ZeroDenominatorException
     * @throws InvalidFractionTypeException
     */
    public function testBothParamsAreInt(): void {
        $number1 = 2;
        $number2 = 3;

        $expected = new MixedFraction(6, null, null, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFraction(): void {
        $fraction1 = new Fraction(2, 3, true);
        $fraction2 = new Fraction(3, 4, true);

        $expected = new Fraction(1, 2, true);
        $actual = self::$operation::multiply($fraction1, $fraction2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are MixedFraction
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreMixedFraction(): void {
        $fraction1 = new MixedFraction(1, 5, 12, true);
        $fraction2 = new MixedFraction(1, 1, 3, true);

        $expected = new MixedFraction(1, 8, 9, true);
        $actual = self::$operation::multiply($fraction1, $fraction2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are float
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFloat(): void {
        $number1 = 4 / 11;
        $number2 = 11 / 6;

        $expected = new Fraction(2, 3, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are mixed fractions with only wholePart
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreMixedFractionWithOnlyWholePart(): void {
        $fraction1 = new MixedFraction(2, null, null, true);
        $fraction2 = new MixedFraction(3, null, null, true);

        $expected = new MixedFraction(6, null, null, true);
        $actual = self::$operation::multiply($fraction1, $fraction2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Number1 is int, number2 is Fraction
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testNumber1IsIntAndNumber2IsFraction(): void {
        $number1 = 7;
        $number2 = new Fraction(5, 7, true);

        $expected = new MixedFraction(5, null, null, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Number1 is Fraction, number2 is int
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testNumber1IsFractionAndNumber2IsInt(): void {
        $number1 = new Fraction(5, 7, true);
        $number2 = 7;

        $expected = new MixedFraction(5, null, null, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Number1 is int, number2 is MixedFraction
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testNumber1IsIntAndNumber2IsMixedFraction(): void {
        $number1 = 5;
        $number2 = new MixedFraction(1, 7, 8, true);

        $expected = new MixedFraction(9, 3, 8, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Number1 is MixedFraction, number2 is int
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testNumber1IsMixedFractionAndNumber2IsInt(): void {
        $number1 = new MixedFraction(1, 7, 8, true);
        $number2 = 5;

        $expected = new MixedFraction(9, 3, 8, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Number1 is Fraction, number2 is MixedFraction
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testNumber1IsFractionAndNumber2IsMixedFraction(): void {
        $number1 = new Fraction(5, 9, true);
        $number2 = new MixedFraction(3, 2, 7, true);

        $expected = new MixedFraction(1, 52, 63, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Number1 is MixedFraction, number2 is Fraction, return MixedFraction with only wholePart
     *
     * @return void
     * @throws InvalidFractionTypeException
     * @throws ZeroDenominatorException
     */
    public function testNumber1IsMixedFractionAndNumber2IsFraction(): void {
        $number1 = new MixedFraction(1, 1, 3, true);
        $number2 = new Fraction(2, 3, true);

        $expected = new Fraction(8, 9, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction, 1st param has negative numerator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFractionFirstParamHasNegativeNumerator(): void {
        $number1 = new Fraction(-2, 5, true);
        $number2 = new Fraction(1, 5, true);

        $expected = new Fraction(-2, 25, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction, 1st param has negative numerator and denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFractionFirstParamHasNegativeNumeratorAndNegativeDenominator(): void {
        $number1 = new Fraction(-2, -5, true);
        $number2 = new Fraction(1, 5, true);

        $expected = new Fraction(2, 25, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction, both params has negative numerator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFractionAndBothParamsHasNegativeNumerator(): void {
        $number1 = new Fraction(-2, 5, true);
        $number2 = new Fraction(-1, 5, true);

        $expected = new Fraction(2, 25, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction, 1st param has negative denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFractionFirstParamHasNegativeDenominator(): void {
        $number1 = new Fraction(2, -5, true);
        $number2 = new Fraction(1, 5, true);

        $expected = new Fraction(-2, 25, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction, 1st param has negative numerator and denominator, 2nd param has negative numerator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFractionFirstParamHasNegativeNumeratorAndDenominatorSecondParamHasNegativeNumerator(): void {
        $number1 = new Fraction(-2, -5, true);
        $number2 = new Fraction(-1, 5, true);

        $expected = new Fraction(-2, 25, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }

    /**
     * Both params are Fraction, 1st param has negative numerator and denominator, 2nd param has negative denominator
     *
     * @return void
     * @throws ZeroDenominatorException
     */
    public function testBothParamsAreFractionFirstParamHasNegativeNumeratorAndDenominatorSecondParamHasNegativeDenominator(): void {
        $number1 = new Fraction(-2, -5, true);
        $number2 = new Fraction(1, -5, true);

        $expected = new Fraction(-2, 25, true);
        $actual = self::$operation::multiply($number1, $number2);

        self::assertEquals($expected, $actual);
    }
}