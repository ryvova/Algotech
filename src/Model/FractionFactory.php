<?php declare(strict_types = 1);

namespace Algotech\Model;

use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Interfaces\IFraction;
use Algotech\Utils;

/**
 * Factory for creating Fraction/Mixed Fraction type objects
 * (Singleton fans can modify this class to be a Singleton similar to the Operation class)
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class FractionFactory {
    /**
     * Create Fraction/MixedFraction object
     *
     * @param int $numerator
     * @param int $denominator
     *
     * @return IFraction
     * @throws ZeroDenominatorException
     */
    public function createFraction(int $numerator, int $denominator): IFraction {
        if ($denominator === 0) {
            throw new ZeroDenominatorException();
        }

        if ($numerator % $denominator === 0) {
            $wholePart = $numerator / $denominator;

            return new MixedFraction($wholePart, null, null, true);
        }
        else {
            $greatestCommonDivisor = Utils::findGreatestCommonDivisor($numerator, $denominator);

            $numerator /= $greatestCommonDivisor;
            $denominator /= $greatestCommonDivisor;

            if (($numerator < 0) && ($denominator < 0)) {
                $numerator = abs($numerator);
                $denominator = abs($denominator);
            }
            elseif (($numerator >= 0) && ($denominator < 0)) {
                $numerator *= -1;
                $denominator = abs($denominator);
            }

            if (abs($numerator) > $denominator) {
                $wholePart = intdiv($numerator, $denominator);
                $numerator -= $wholePart * $denominator;

                if ($numerator < 0) {
                    $numerator = abs($numerator);
                }

                $greatestCommonDivisor = Utils::findGreatestCommonDivisor($numerator, $denominator);
                $numerator /= $greatestCommonDivisor;
                $denominator /= $greatestCommonDivisor;

                /** @var int $numerator */
                /** @var int $denominator */
                return new MixedFraction($wholePart, $numerator, $denominator, true);
            } else {
                return new Fraction($numerator, $denominator);
            }
        }
    }
}