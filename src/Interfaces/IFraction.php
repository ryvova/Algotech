<?php declare(strict_types = 1);

namespace Algotech\Interfaces;

interface IFraction{
    public function __toString(): string;

    public function getNumerator(): ?int;

    public function getDenominator(): ?int;
}