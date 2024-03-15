<?php declare(strict_types = 1);

namespace Algotech\Model;

use Algotech\Exceptions\InvalidFractionTypeException;
use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Interfaces\IFraction;
use Algotech\Utils;

/**
 * Class for working with fractions
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class Fraction implements IFraction {
    /**
     * @param int  $numerator
     * @param int  $denominator
     * @param bool $reduced
     *
     * @throws ZeroDenominatorException denominator can't be zero
     */
    public function __construct(private int $numerator, private int $denominator, bool $reduced = false) {
        if ($denominator === 0) {
            throw new ZeroDenominatorException();
        }

        if (($numerator < 0) && ($denominator < 0)) {
            $numerator = abs($numerator);
            $denominator = abs($denominator);
        }
        elseif (($numerator >= 0) && ($denominator < 0)) {
            $numerator *= -1;
            $denominator = abs($denominator);
        }

        if ($numerator >= abs($denominator)) {
            throw new InvalidFractionTypeException();
        }

        if ($reduced === false) {
            $this->reduce();
        }
    }

    use FractionTrait;

    public function __toString(): string {
        return "{$this->numerator} / {$this->denominator}";
    }

    public function getNumerator(): int {
        return $this->numerator;
    }

    public function setNumerator(int $numerator): void {
        $this->numerator = $numerator;
    }

    public function getDenominator(): int {
        return $this->denominator;
    }

    public function setDenominator(int $denominator): void {
        $this->denominator = $denominator;
    }
}