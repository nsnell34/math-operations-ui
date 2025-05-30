<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';

use InvalidArgumentException;
use TypedValue;

class RangeHandler implements \Operations\OperationHandler {
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
            throw new InvalidArgumentException("Invalid input");
        }
        
        $range =  max($sanitizedInput) - min($sanitizedInput);
        $resultSet['median'] = new TypedValue($range, 'float');
        return $resultSet;
    }
}