<?php

namespace Operations;
require_once __DIR__ . '/OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class FactorialHandler implements OperationHandler {
    public function sanitize(string $input): int {
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
        if ($sanitizedInput <= 1){
            $resultSet['factorial'] = new TypedValue($sanitizedInput, 'integer');
            return $resultSet;
        }
        $factorial = 1;
        for ($i = $sanitizedInput; $i > 0; $i--){
            if ($i == 0){
                break;
            }

            $factorial *= $i;
        }

        $resultSet['factorial'] = new TypedValue($factorial, 'integer');
        return $resultSet;
    }
}