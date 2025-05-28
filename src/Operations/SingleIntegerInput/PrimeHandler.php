<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class PrimeHandler implements \Operations\OperationHandler {
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
        if (!is_numeric($sanitizedInput) || $sanitizedInput < 2 || floor($sanitizedInput) != $sanitizedInput) {
            $resultSet['prime'] = new TypedValue(false, 'boolean');
            return $resultSet;
        }

        $n = (int)$sanitizedInput;

        for ($i = 2; $i <= sqrt($n); $i++) {
            if ($n % $i === 0) {
                $resultSet['prime'] = new TypedValue(false, 'boolean');
                return $resultSet;
            }
        }   

        $resultSet['prime'] = new TypedValue(true, 'boolean');
        return $resultSet;
    }
}