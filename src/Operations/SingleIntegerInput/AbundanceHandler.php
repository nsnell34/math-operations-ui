<?php

namespace Operations\SingleIntegerInput;
require_once __DIR__ . '/../OperationHandler.php';

use TypedValue;
use InvalidArgumentException;

class AbundanceHandler implements \Operations\OperationHandler {
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
        $sum = $this->getAbundance($n);

        if ($sum == $n){
            $result[$sum] = "Perfect";
        } elseif($sum > $n){
            $result[$sum] = "Abundant";
        }else {
            $result[$sum] = "Deficient";
        }

        $resultSet['abundance'] = new TypedValue($result, 'array');
        return $resultSet;
    }

    public function getAbundance($n, &$count = 0){
        $sum = 0;
        for ($i = 1; $i <= $n / 2; $i++) {
            if ($n % $i === 0) {
                $sum += $i;
            }
        }

        return $sum;
    }
}