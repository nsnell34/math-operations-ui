<?php

namespace Operations\ArrayInput;
require_once __DIR__ . '/../OperationHandler.php';
include_once 'MeanHandler.php';
include_once 'StandardDeviationHandler.php';

use InvalidArgumentException;
use TypedValue;

class KurtosisnHandler implements \Operations\OperationHandler {
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

        $final =  $this->getKurtosis($sanitizedInput);
        $formatted = rtrim(rtrim(number_format($final, 4, '.', ''), '0'), '.');
        $resultSet['kurtosis'] =  new TypedValue($formatted, 'float');

        return $resultSet;
    }

    public static function getKurtosis($input){
        $n = count($input);
        if ($n < 4) {
            throw new InvalidArgumentException("At least 4 data points required for kurtosis.");
        }

        $mean = MeanHandler::getMean($input);
        $standardDeviation = StandardDeviationHandler::getStandardDeviation($input);
    
        $kurtSum = 0.0;
        foreach ($input as $value) {
            $stdScore = ($value - $mean) / $standardDeviation;
            $kurtSum += pow($stdScore, 4);
        }

        $kurtosis = (($n * ($n + 1)) / (($n - 1) * ($n - 2) * ($n - 3))) * $kurtSum - (3 * pow($n - 1, 2) / (($n - 2) * ($n - 3)));

    return $kurtosis;
    }
}