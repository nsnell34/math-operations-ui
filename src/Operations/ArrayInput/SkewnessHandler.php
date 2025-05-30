<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';
include_once 'StandardDeviationHandler.php';

use InvalidArgumentException;
use TypedValue;

class SkewnessnHandler implements \Operations\OperationHandler {
    public function sanitize(string $input): array {
        $items = explode(',', $input);
        $numbers = [];

        foreach ($items as $item) {
            $trimmed = trim($item);
            if (!is_numeric($trimmed)) {
                throw new InvalidArgumentException("Invalid input.");
            }
            $numbers[] = (float) $trimmed;
        }

        return $numbers;
    }

    public function execute(mixed $sanitizedInput): mixed {
        if (!is_array($sanitizedInput) || empty($sanitizedInput)) {
            throw new InvalidArgumentException("Invalid input.");
        }

        $final =  $this->getSkewness($sanitizedInput);
        $formatted = rtrim(rtrim(number_format($final, 4, '.', ''), '0'), '.');
        $resultSet['skewness'] =  new TypedValue($formatted, 'float');

        return $resultSet;
    }

    public static function getSkewness($input){
        $mean = array_sum($input) / count($input);
        $deviation = StandardDeviationHandler::getStandardDeviation($input);
        $stm = [];
        foreach ($input as $value){
            $stm[] = pow(($value - $mean) / $deviation, 3);
        }

        $stmSum = array_sum($stm);
        $count = count($input);
        return ($count / (($count - 1) * ($count - 2))) * $stmSum;
    }
}