<?php

namespace Operations;
require_once __DIR__ . '/OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class LeastCommonMultipleHandler implements OperationHandler {
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

        $LCM = abs($a * $b) / $this->gcd($a, $b);

        $resultSet['LCM'] = new TypedValue($LCM, 'integer');
        return $resultSet;
    }

    public static function gcd(int $a, int $b): int
    {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }
}