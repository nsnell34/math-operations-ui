<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';
include_once 'VarianceHandler.php';

use InvalidArgumentException;
use TypedValue;

class StandardDeviationHandler implements \Operations\OperationHandler {
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

        $deviation = $this->getStandardDeviation($sanitizedInput);
        $formatted = rtrim(rtrim(number_format($deviation, 4, '.', ''), '0'), '.');

        $resultSet['standardDeviation'] =  new TypedValue($formatted, 'float');

        return $resultSet;
    }

    public static function getStandardDeviation($input){
        $variance = VarianceHandler::getVariance($input);
        return sqrt($variance);
    }
}