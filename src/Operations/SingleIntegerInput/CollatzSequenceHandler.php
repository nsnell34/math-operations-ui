<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class CollatzSequenceHandler implements \Operations\OperationHandler {
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
        
        $steps = $this->getCollatzResult($n);

        $resultSet['collatzSequence'] = new TypedValue($steps, 'integer');
        return $resultSet;
    }

    public function getCollatzResult($n, &$count = 0){
        if ($n === 1){
            return $count;
        }

        $count++; 

        if ($n % 2 === 0){
            return $this->getCollatzResult($n / 2, $count);
        } else {
            return $this->getCollatzResult($n * 3 + 1, $count);
        }
    }
}