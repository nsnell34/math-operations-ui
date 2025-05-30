<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
include_once 'Functions.php';
include_once 'Parser.php';
include_once 'Operations/TypedValue.php';
include_once 'Operations/OperationHandler.php';

include_once 'Operations/ArrayInput/SummationHandler.php';
include_once 'Operations/ArrayInput/MedianHandler.php';
include_once 'Operations/ArrayInput/ModeHandler.php';
include_once 'Operations/ArrayInput/StandardDeviationHandler.php';
include_once 'Operations/ArrayInput/VarianceHandler.php';
include_once 'Operations/ArrayInput/QuartileHandler.php';
include_once 'Operations/ArrayInput/MeanHandler.php';
include_once 'Operations/ArrayInput/GeometricMeanHandler.php';
include_once 'Operations/ArrayInput/HarmonicMeanHandler.php';
include_once 'Operations/ArrayInput/InterquartileRangeHandler.php';
include_once 'Operations/ArrayInput/SkewnessHandler.php';
include_once 'Operations/ArrayInput/KurtosisHandler.php';
include_once 'Operations/ArrayInput/RangeHandler.php';

include_once 'Operations/SingleIntegerInput/PrimeHandler.php';
include_once 'Operations/SingleIntegerInput/PrimeFactorizationHandler.php';
include_once 'Operations/SingleIntegerInput/FactorialHandler.php';
include_once 'Operations/SingleIntegerInput/FibonacciHandler.php';

include_once 'Operations/DoubleIntegerInput/LeastCommonMultipleHandler.php';
include_once 'Operations/DoubleIntegerInput/GreatestCommonFactorHandler.php';


use MathParser\StdMathParser;

header('Content-Type: application/json');

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true); 

    if (!isset($data['input'], $data['operation'], $data['isNumeric'])) {
        throw new InvalidArgumentException('Invalid request. Missing parameters.');
    }

    $input = $data['input'];
    $operation = $data['operation'];
    $isNumeric = $data['isNumeric'];

    if (!$isNumeric) {
         //create new handling class for this... 
        $varParser = new StdMathParser();
        $ast = $varParser->parse($input);
        $parser = new Parser($ast);

        $result = $parser->terms; 
    } else {
        $functionRunner = new Functions($operation);
        $result = $functionRunner->run($input);
    }

    echo json_encode([
        'success' => true,
        'result' => $result
    ]);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
