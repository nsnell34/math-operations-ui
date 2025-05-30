<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class EulersTotientHandler implements \Operations\OperationHandler {
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
        $count = 0;
        $coprimes = [];

        for ($i = 1; $i <= $n; $i++) {
            if ($this->gcd($i, $n) == 1) {
                $coprimes[] = $i;
                $count++;
            }
        }

        $resultSet['eulersTotient'] = new TypedValue($count, 'integer');
        $resultSet['coprimes'] = new TypedValue($coprimes, 'array');
        return $resultSet;
    }

    public function gcd($a, $b) {
        return $b == 0 ? $a : $this->gcd($b, $a % $b);
    }

}