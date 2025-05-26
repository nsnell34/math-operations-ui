<?php

namespace Operations;
require_once __DIR__ . '/OperationHandler.php';

use InvalidArgumentException;
use TypedValue;

class MeanHandler implements OperationHandler {
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
        $resultSet['mean'] = new TypedValue($mean, 'float');
        return $resultSet;
    }
}