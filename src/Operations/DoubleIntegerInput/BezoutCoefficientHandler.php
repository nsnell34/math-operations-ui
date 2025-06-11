<?php

namespace Operations\DoubleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class BezoutCoefficientHandler implements \Operations\OperationHandler {
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

        $arrayVals = $this->extendedGCD($a, $b);
        $gcd = $arrayVals[0];
        $x = $arrayVals[1];
        $y = $arrayVals[2];

        $formatted = [
            'GCD' => $gcd,
            'X' => $x,
            'Y' => $y
        ];

        $resultSet['BezoutCoefficients'] = new TypedValue($formatted, 'array');

        return $resultSet;
    }

    function extendedGCD($a, $b) {
        if ($b == 0) {
            return [$a, 1, 0];
        }
    
        $result = $this->extendedGCD($b, $a % $b);
        $gcd = $result[0];
        $x1 = $result[1];
        $y1 = $result[2];
    
        $x = $y1;
        $y = $x1 - intdiv($a, $b) * $y1;
    
        return [$gcd, $x, $y];
    }

}