<?php declare(strict_types = 1);

namespace Algotech;

use Algotech\Exceptions\InvalidFractionTypeException;
use Algotech\Interfaces\IFraction;
use Algotech\Model\Fraction;
use Algotech\Model\FractionFactory;
use Algotech\Model\MixedFraction;
use Algotech\Exceptions\ZeroDenominatorException;

/**
 * A class for fractional operations used the singleton design pattern
 * (I'm not dealing with provisioning a single instance in a multi-threaded environment)
 * (I don't like Singleton - see https://cs.wikipedia.org/wiki/Singleton)
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class Operation
{
    private static Operation $instance;

    private static FractionFactory $fractionFactory;

    private function __construct() {
        self::$fractionFactory = new FractionFactory();
    }

    /**
     * Return singleton instance
     * @codeCoverageIgnore
     *
     * @return Operation
     */
    public static function getInstance(): Operation {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Add two int/float/Fractions/MixedFractions
     *
     * @param int|float|IFraction $number1
     * @param int|float|IFraction $number2
     *
     * @return IFraction
     * @throws ZeroDenominatorException
     */
    public static function add(int|float|IFraction $number1, int|float|IFraction $number2): IFraction {
        if (is_int($number1) && is_int($number2)) {
            return self::$fractionFactory->createFraction($number1 + $number2, 1);
        }

        $fraction1 = self::convertParamIntoArray($number1);
        $fraction2 = self::convertParamIntoArray($number2);

        $numerator =
            $fraction1["numerator"] * $fraction2["denominator"] +
            $fraction1["denominator"] * $fraction2["numerator"];

        $denominator = $fraction1["denominator"] * $fraction2["denominator"];

        return self::$fractionFactory->createFraction($numerator, $denominator);
    }

    /**
     * Subtract two int/float/Fractions/MixedFractions
     *
     * @param int|float|IFraction $number1
     * @param int|float|IFraction $number2
     *
     * @return IFraction
     * @throws ZeroDenominatorException
     */
    public static function subtract(int|float|IFraction $number1, int|float|IFraction $number2): IFraction {
        if (is_int($number1) && is_int($number2)) {
            return self::$fractionFactory->createFraction($number1 - $number2, 1);
        }

        $fraction1 = self::convertParamIntoArray($number1);
        $fraction2 = self::convertParamIntoArray($number2);

        $numerator =
            $fraction1["numerator"] * $fraction2["denominator"] -
            $fraction1["denominator"] * $fraction2["numerator"];

        $denominator = $fraction1["denominator"] * $fraction2["denominator"];

        return self::$fractionFactory->createFraction($numerator, $denominator);
    }

    /**
     * Multiply two int/float/Fractions/MixedFractions
     *
     * @param int|float|IFraction $number1
     * @param int|float|IFraction $number2
     *
     * @return IFraction
     * @throws ZeroDenominatorException
     */
    public static function multiply(int|float|IFraction $number1, int|float|IFraction $number2): IFraction {
        if (is_int($number1) && is_int($number2)) {
            return self::$fractionFactory->createFraction($number1 * $number2, 1);
        }

        $fraction1 = self::convertParamIntoArray($number1);
        $fraction2 = self::convertParamIntoArray($number2);

        $numerator = $fraction1["numerator"] * $fraction2["numerator"];
        $denominator = $fraction1["denominator"] * $fraction2["denominator"];

        return self::$fractionFactory->createFraction($numerator, $denominator);
    }

    /**
     * Divide two int/float/Fractions/MixedFractions
     *
     * @param int|float|IFraction $number1
     * @param int|float|IFraction $number2
     *
     * @return IFraction
     * @throws ZeroDenominatorException
     * @throws InvalidFractionTypeException
     */
    public static function divide(int|float|IFraction $number1, int|float|IFraction $number2): IFraction {
        if (is_int($number1)) {
            $number1 = new MixedFraction($number1, null, null, true);
        }

        if (is_int($number2)) {
            $number2 = new Fraction(1, $number2, true);
        }
        else {
            // for the 2nd fraction, we change the numerator and denominator
            /** @var Fraction|MixedFraction $number2 */
            $fraction2 = self::convertParamIntoArray($number2);
            /** @var array{numerator: int, denominator: int} $fraction2 */
            $number2 = (new FractionFactory())->createFraction($fraction2["denominator"], $fraction2["numerator"]);
        }

        return self::multiply($number1, $number2);
    }

    /**
     * Convert MixedFraction into array
     *
     * @param MixedFraction $fraction
     * @return array{numerator: int|null, denominator: int}
     */
    private static function mixedFraction2Array(MixedFraction $fraction): array {
        if ($fraction->getDenominator() === null) {
            $numerator = $fraction->getWholePart();
            $denominator = 1;
        }
        else {
            $numerator = $fraction->getWholePart() * $fraction->getDenominator() + $fraction->getNumerator();
            $denominator = $fraction->getDenominator();
        }

        return ["numerator" => $numerator, "denominator" => $denominator];
    }

    /**
     * Convert int/Fraction/MixedFraction into array
     *
     * @param int|float|IFraction $param
     *
     * @return array{numerator: int|null, denominator: int|null}
     */
    private static function convertParamIntoArray(int|float|IFraction $param): array {
        if (is_int($param)) {
            $fraction = ["numerator" => $param, "denominator" => 1];
        }
        elseif (is_float($param)) {
            $fraction = self::convertParamIntoArray(Utils::decimal2fraction($param));
        }
        elseif ($param instanceof MixedFraction) {
            $fraction = self::mixedFraction2Array($param);
        }
        else {
            $fraction = ["numerator" => $param->getNumerator(), "denominator" => $param->getDenominator()];
        }

        return $fraction;
    }

    /**
     * Singleton clone isn't allowed!
     *
     * @return void
     */
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    /**
     * Singleton unserializing isn't allowed!
     *
     * @return void
     */
    public function __wakeup() {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }
}