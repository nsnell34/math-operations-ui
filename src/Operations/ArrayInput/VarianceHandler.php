<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';

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


        $mean = array_sum($sanitizedInput) / count($sanitizedInput);
        $squaredDiffs = [];
        foreach ($sanitizedInput as $key => $value){
            $squaredDiffs[] = ($value - $mean) ** 2;

        }

        $variance = array_sum($squaredDiffs) / count($squaredDiffs);

        $resultSet['variance'] = new TypedValue($variance, 'float');

        return $resultSet;
    }
}