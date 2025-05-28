<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class PrimeFactorizationHandler implements \Operations\OperationHandler {
    public function sanitize(mixed $input): int {
        $stringInput = (string)$input;
    
        if (!preg_match('/^-?\d+$/', $stringInput)) {
            throw new InvalidArgumentException("Invalid input.");
        }

        if ((int)$stringInput < 0){
            throw new InvalidArgumentException("Invalid input.");
        }
    
        return (int)$stringInput;
    }

    public function execute(mixed $sanitizedInput): mixed {
        $n = (int)$sanitizedInput;
        if ($n < 2) {
            throw new InvalidArgumentException("Number must be 2 or greater for prime factorization.");
        }
        $factors = [];
        while ($n % 2 == 0){
            $factors[] = new TypedValue(2, 'integer');
            $n /= 2;
        }
        for ($i = 3; $i <= sqrt($n); $i = $i + 2){
            while ($n % $i == 0 ){
                $factors[] = new TypedValue($i, 'integer');
                $n /= $i;
            }
        }

        if ($n > 2){
            $factors[] = new TypedValue($n, 'integer');
        }

        $resultSet['primeFactorization'] = $factors;
        return $resultSet;
    }
}