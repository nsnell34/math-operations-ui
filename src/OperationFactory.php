<?php
use Operations\FactorialHandler;
use Operations\FibonacciHandler;
use Operations\GreatestCommonFactorHandler;
use Operations\LeastCommonMultipleHandler;
use Operations\MeanHandler;
use Operations\MedianHandler;
use Operations\PrimeFactorizationHandler;
use Operations\PrimeHandler;
use Operations\QuartileHandler;
use Operations\StandardDeviationHandler;
use Operations\SummationHandler;
use Operations\OperationHandler;
use Operations\ModeHandler;
use Operations\VarianceHandler;

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