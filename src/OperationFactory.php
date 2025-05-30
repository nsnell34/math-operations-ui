<?php
use Operations\ArrayInput\GeometricMeanHandler;
use Operations\ArrayInput\HarmonicMeanHandler;
use Operations\ArrayInput\InterquartileRangeHandler;
use Operations\ArrayInput\KurtosisnHandler;
use Operations\ArrayInput\MeanHandler;
use Operations\ArrayInput\MedianHandler;
use Operations\ArrayInput\ModeHandler;
use Operations\ArrayInput\RangeHandler;
use Operations\ArrayInput\SkewnessnHandler;
use Operations\ArrayInput\StandardDeviationHandler;
use Operations\ArrayInput\SummationHandler;
use Operations\ArrayInput\VarianceHandler;
use Operations\ArrayInput\QuartileHandler;

use Operations\SingleIntegerInput\CollatzSequenceHandler;
use Operations\SingleIntegerInput\PrimeHandler;
use Operations\SingleIntegerInput\PrimeFactorizationHandler;
use Operations\SingleIntegerInput\FactorialHandler;
use Operations\SingleIntegerInput\FibonacciHandler;

use Operations\DoubleIntegerInput\GreatestCommonFactorHandler;
use Operations\DoubleIntegerInput\LeastCommonMultipleHandler;

use Operations\OperationHandler;
use Operations\SingleIntegerInput\TriangularNumbersHandler;

class OperationFactory {
    public static function getHandler(string $operation): ?OperationHandler {
        return match (strtolower($operation)) {
            'mean' => new MeanHandler(),
            'summation' => new SummationHandler(),
            'median' => new MedianHandler(),
            'mode' => new ModeHandler(),
            'range' => new RangeHandler(),
            'standarddeviation' => new StandardDeviationHandler(),
            'variance' => new VarianceHandler(),
            'quartiles' => new QuartileHandler(),
            'primecheck' => new PrimeHandler(),
            'primefactorization' => new PrimeFactorizationHandler(),
            'factorial' => new FactorialHandler(),
            'fibonacci' => new FibonacciHandler(),
            'greatestcommonfactor' => new GreatestCommonFactorHandler(),
            'leastcommonmultiple' => new LeastCommonMultipleHandler(),
            'geometricmean' => new GeometricMeanHandler(),
            'harmonicmean' => new HarmonicMeanHandler(),
            'interquartilerange' => new InterquartileRangeHandler(),
            'skewness' => new SkewnessnHandler(),
            'kurtosis' => new KurtosisnHandler(),
            'triangular' => new TriangularNumbersHandler(),
            'collatzsequence' => new CollatzSequenceHandler(),
            default => null
        };
    }
}