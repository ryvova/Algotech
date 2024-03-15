<?php declare(strict_types = 1);

namespace Algotech\Exceptions;

use Exception;
use Throwable;

/**
 * Exception for denominator = 0
 *
 * @author Anna Rývová
 * @copyright Anna Rývová, 2024
 */
class ZeroDenominatorException extends Exception {
    public function __construct(int $code = 0, Throwable $previous = null) {
        $message = "Denominator can't be zero";

        parent::__construct($message, $code, $previous);
    }
}