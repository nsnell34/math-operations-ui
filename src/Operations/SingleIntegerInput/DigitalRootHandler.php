<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class DigitalRootHandler implements \Operations\OperationHandler {
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

        $root = $this->digitalRoot($n);

        $resultSet['triangularNumbers'] = new TypedValue($root, 'integer');
        return $resultSet;
    }

    public function digitalRoot($n) {
        if ($n == 0) return 0;
        return ($n % 9 == 0) ? 9 : $n % 9;
    }
}