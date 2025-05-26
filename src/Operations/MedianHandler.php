<?php

namespace Operations;
require_once __DIR__ . '/OperationHandler.php';

use InvalidArgumentException;
use TypedValue;

class MedianHandler implements OperationHandler {
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

        sort($sanitizedInput);
        $arrayCount = count($sanitizedInput);
        if ($arrayCount % 2 === 0){
            $mid1 = $sanitizedInput[$arrayCount / 2 - 1];
            $mid2 = $sanitizedInput[$arrayCount / 2];

            $median = ($mid1 + $mid2) / 2;
            $resultSet['median'] = new TypedValue($median, 'float');
            return $resultSet;
        } else {
            $resultSet['median'] = new TypedValue($sanitizedInput[floor($arrayCount / 2)], 'float');
            return $resultSet;
        }
    }
}