<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';

use InvalidArgumentException;
use TypedValue;

class HarmonicMeanHandler implements \Operations\OperationHandler {
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

        $total = 0.0;
        foreach ($sanitizedInput as $value){
            $total += (1 / $value);
        }

        $harmonicMean = count($sanitizedInput) / $total;
        $formatted = rtrim(rtrim(number_format($harmonicMean, 4, '.', ''), '0'), '.');

        $resultSet['harmonicMean'] = new TypedValue($formatted, 'float');
        return $resultSet;
    }
}