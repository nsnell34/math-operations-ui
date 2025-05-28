<?php
use Operations\ArrayInput\MeanHandler;
use Operations\ArrayInput\MedianHandler;
use Operations\ArrayInput\ModeHandler;
use Operations\ArrayInput\StandardDeviationHandler;
use Operations\ArrayInput\SummationHandler;
use Operations\ArrayInput\VarianceHandler;
use Operations\ArrayInput\QuartileHandler;

use Operations\SingleIntegerInput\PrimeHandler;
use Operations\SingleIntegerInput\PrimeFactorizationHandler;
use Operations\SingleIntegerInput\FactorialHandler;
use Operations\SingleIntegerInput\FibonacciHandler;

use Operations\DoubleIntegerInput\GreatestCommonFactorHandler;
use Operations\DoubleIntegerInput\LeastCommonMultipleHandler;

use Operations\OperationHandler;

class OperationFactory {
    public static function getHandler(string $operation): ?OperationHandler {
        return match (strtolower($operation)) {
            'mean' => new MeanHandler(),
            'summation' => new SummationHandler(),
            'median' => new MedianHandler(),
            'mode' => new ModeHandler(),
            'standarddeviation' => new StandardDeviationHandler(),
            'variance' => new VarianceHandler(),
            'quartiles' => new QuartileHandler(),
            'primecheck' => new PrimeHandler(),
            'primefactorization' => new PrimeFactorizationHandler(),
            'factorial' => new FactorialHandler(),
            'fibonacci' => new FibonacciHandler(),
            'greatestcommonfactor' => new GreatestCommonFactorHandler(),
            'leastcommonmultiple' => new LeastCommonMultipleHandler(),
            default => null
        };
    }
}