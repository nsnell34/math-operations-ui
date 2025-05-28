<?php

namespace Operations;
require_once __DIR__ . '/OperationHandler.php';
include_once 'LeastCommonMultipleHandler.php';

use TypedValue;
use InvalidArgumentException;

class GreatestCommonFactorHandler implements OperationHandler {
    public function sanitize(mixed $input): array {
        $stringInput = (string)$input;
    
        $numbers = explode(" ", $stringInput);
        if (count($numbers) !== 2){
            throw new InvalidArgumentException("Invalid input.");
        }

        return $numbers;
    }

    public function execute(mixed $sanitizedInput): mixed {
        $a = (int)$sanitizedInput[0];
        $b = (int)$sanitizedInput[1];

        $gcd = LeastCommonMultipleHandler::gcd($a, $b);

        $resultSet['GCD'] = new TypedValue($gcd, 'integer');

        return $resultSet;
    }

}