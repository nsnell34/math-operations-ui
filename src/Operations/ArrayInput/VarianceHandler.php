<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';
include_once 'MeanHandler.php';

use InvalidArgumentException;
use TypedValue;

class VarianceHandler implements \Operations\OperationHandler {
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

        $variance = $this->getVariance($sanitizedInput);
        $formatted = rtrim(rtrim(number_format($variance, 4, '.', ''), '0'), '.');

        $resultSet['variance'] = new TypedValue($formatted, 'float');

        return $resultSet;
    }

    public static function getVariance($input){
        $mean = MeanHandler::getMean($input);
        $squaredDiffs = [];
        foreach ($input as $key => $value){
            $squaredDiffs[] = ($value - $mean) ** 2;

        }
        return array_sum($squaredDiffs) / (count($squaredDiffs) - 1);
    }
}