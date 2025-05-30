<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class TriangularNumbersHandler implements \Operations\OperationHandler {
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

        $triangularNumbers = [];
        $total = 0;

        for ($i = 1; $i <= $n; $i++){
            $total += $i;
            $triangularNumbers[] = $total;
        }

        $resultSet['triangularNumbers'] = new TypedValue($triangularNumbers, 'array');
        return $resultSet;
    }
}