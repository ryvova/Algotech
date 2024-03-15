<?php declare(strict_types = 1);

namespace Algotech\Model;

use Algotech\Exceptions\InvalidFractionTypeException;
use Algotech\Exceptions\ZeroDenominatorException;
use Algotech\Interfaces\IFraction;

/**
 * Exception for denominator = 0
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class MixedFraction implements IFraction {
    public function __construct(
        private ?int $wholePart = null,
        private ?int $numerator = null,
        private ?int $denominator = null,
        bool $reduced = false
    ) {
        if ($denominator === 0) {
            throw new ZeroDenominatorException();
        }
        elseif (($wholePart === null) && ($numerator < $denominator)) {
            throw new InvalidFractionTypeException(1);
        }

        if ($reduced === false) {
            $this->reduce();
        }
    }

    use FractionTrait {
        FractionTrait::reduce as fractionReduce;
    }

    private function reduce(): void {
        if (
            ($this->numerator !== null) &&
            ($this->denominator !== null) &&
            (($this->numerator % $this->denominator) === 0)
        ) {
            $this->wholePart = $this->numerator / $this->denominator;
            $this->numerator = null;
            $this->denominator = null;
        }
        else {
            $this->fractionReduce();

            if (($this->numerator !== null) && ($this->denominator !== null)) {
                if (abs($this->numerator) > $this->denominator) {
                    $this->wholePart = intdiv($this->numerator, $this->denominator);

                    $numerator =
                        ($this->numerator >= 0) ?
                            $this->numerator - $this->wholePart * $this->denominator :
                            abs($this->numerator - $this->wholePart * $this->denominator);

                    $this->setNumerator($numerator);

                }
            }
        }
    }

    public function getWholePart(): ?int {
        return $this->wholePart;
    }

    public function setWholePart(?int $wholePart): void {
        $this->wholePart = $wholePart;
    }

    /**
     * @return int|null
     */
    public function getNumerator(): ?int {
        return $this->numerator;
    }

    /**
     * @param int|null $numerator
     */
    public function setNumerator(?int $numerator): void {
        $this->numerator = $numerator;
    }

    /**
     * @return int|null
     */
    public function getDenominator(): ?int {
        return $this->denominator;
    }

    /**
     * @param int|null $denominator
     */
    public function setDenominator(?int $denominator): void {
        $this->denominator = $denominator;
    }


    public function __toString(): string {
        return
            ($this->numerator !== null) ?
                "{$this->wholePart} {$this->numerator}/{$this->denominator}" :
                "{$this->wholePart}";
    }
}