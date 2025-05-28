<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';

use InvalidArgumentException;
use TypedValue;

class ModeHandler implements \Operations\OperationHandler {
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

        $modeValues = [];
        $modeMap = [];

        foreach ($sanitizedInput as $value){
            if (!isset($modeMap[$value])) {
                $modeMap[$value] = 1;
            } else {
                $modeMap[$value]++;
            }
            
        }
        $frequencies = array_values($modeMap);
        $uniqueFrequencies = array_unique($frequencies);

        if (count($uniqueFrequencies) === 1 && $uniqueFrequencies[0] === 1) {
            $resultSet['mode'] = new TypedValue(null, 'null');
            return $resultSet;
        }

        $maxCount = max($frequencies);

        foreach ($modeMap as $key => $count) {
            if ($count === $maxCount) {
                $modeValues[] = $key;
            }
        }

        $resultSet['mode'] = new TypedValue($modeValues, 'array');
        return $resultSet;
    }
}