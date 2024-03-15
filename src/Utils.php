<?php declare(strict_types = 1);

namespace Algotech;

use Algotech\Interfaces\IFraction;
use Algotech\Model\FractionFactory;

/**
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 *
 * Library of functions for working with fractions
 */

class Utils {
    /**
     * Finds the greatest common divisor of two integers using the Euclidean algorithm.
     * See https://en.wikipedia.org/wiki/Euclidean_algorithm
     * (I don't use recursion for high memory consumption)
     *
     * @param int $number1
     * @param int $number2
     *
     * @return int|null
     */
    public static function findGreatestCommonDivisor(int $number1, int $number2): ?int {
        while ($number2 != 0) {
            $tmp = $number2;
            $number2 = $number1 % $number2;
            $number1 = $tmp;
        }

        return abs($number1);
    }

    /**
     * Convert decimal number to fraction
     * (according to Bing)
     *
     * @param float $number
     * @return IFraction
     * @throws Exceptions\ZeroDenominatorException
     */
    public static function decimal2fraction(float $number): IFraction {
        $accuracy = 1e-10;
        $numerator = 1;
        $h2 = 0;
        $denominator = 0;
        $k2 = 1;
        $b = 1 / $number;

        do {
            $b = 1 / $b;
            $a = floor($b);
            $tmp = $numerator;
            $numerator = $a * $numerator + $h2;
            $h2 = $tmp;
            $tmp = $denominator;
            $denominator = $a * $denominator + $k2;
            $k2 = $tmp;
            $b = $b - $a;
        } while (abs($number - $numerator / $denominator) > $number * $accuracy);

        return (new FractionFactory())->createFraction((int) $numerator, (int) $denominator);
    }
}
