<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';

use InvalidArgumentException;
use TypedValue;

class QuartileHandler implements \Operations\OperationHandler {
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

        sort($sanitizedInput);
        $count = count($sanitizedInput);
        $q1 = $this->getInterpolatedValue($sanitizedInput, ($count + 1) * 0.25);
        $q2 = $this->getInterpolatedValue($sanitizedInput, ($count + 1) * 0.5); 
        $q3 = $this->getInterpolatedValue($sanitizedInput, ($count + 1) * 0.75);

        $resultSet['quartile'] = [new TypedValue($q1, 'float'), new TypedValue($q2, 'float'), new TypedValue($q3, 'float')];

        return $resultSet;
    }

    private function getInterpolatedValue(array $data, float $position): float
    {
        $count = count($data);
        $floorIndex = (int)floor($position) - 1;
        $ceilIndex = (int)ceil($position) - 1;

        $floorIndex = max(0, $floorIndex);
        $ceilIndex = min($count - 1, $ceilIndex);

        $fraction = $position - floor($position);
        $value1 = $data[$floorIndex];
        $value2 = $data[$ceilIndex];

        return $value1 + $fraction * ($value2 - $value1);
    }

}