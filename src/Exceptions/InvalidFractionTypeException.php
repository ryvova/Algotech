<?php declare(strict_types = 1);

namespace Algotech\Exceptions;

use Exception;
use Throwable;

/**
 * Exception for numerator > denominator - use MixedFraction instead of Fraction
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class InvalidFractionTypeException extends Exception {
    public function __construct(int $code = 0, Throwable $previous = null) {
        switch ($code) {
            case 0:
                $message = "Fraction can't have numerator >= denominator. Use MixedFraction.";
                break;

            default:
                $message =  "Fraction can't have numerator < denominator. Use Fraction.";
                break;
        }

        parent::__construct($message, $code, $previous);
    }
}