<?php declare(strict_types = 1);

namespace Algotech\Model;

use Algotech\Utils;

/**
 * Privatizing properties/methods so they don't have to be written repeatedly
 * (I would prefer to use protected, I think it's more clear, but if it can't be protected and I don't like duplicate
 * code, I'll work around it this way)
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */

trait FractionTrait {
    private function reduce(): void {
        if (($this->numerator !== null)) {
            $greatestCommonDivisor = Utils::findGreatestCommonDivisor((int) $this->numerator, (int) $this->denominator);

            if ($this->numerator >= $this->denominator) {
                /** @var MixedFraction $this */
                /** @phpstan-ignore-next-line */
                $this->wholePart = intdiv((int) $this->numerator, (int) $this->denominator);
                /** @phpstan-ignore-next-line */
                $this->numerator -= $this->wholePart * $this->denominator;

                /** @phpstan-ignore-next-line */
                $greatestCommonDivisor = Utils::findGreatestCommonDivisor((int) $this->numerator, (int)$this->denominator);
                /** @phpstan-ignore-next-line */
                $this->numerator /= $greatestCommonDivisor;
            }
            else {
                $this->numerator /= $greatestCommonDivisor;
            }

            $this->denominator /= $greatestCommonDivisor;
        }
    }
}