<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class FibonacciHandler implements \Operations\OperationHandler {
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
        
        $result = $this->fibonacci($sanitizedInput);

        $resultSet['fibonacci'] = new TypedValue($result, 'integer');
        return $resultSet;
    }

    public function fibonacci($n){
        if ($n <= 1){
            return $n;
        }

        return $this->fibonacci($n - 1) + $this->fibonacci($n - 2);

    }
}