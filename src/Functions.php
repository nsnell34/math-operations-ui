<?php
use Operations\OperationHandler;
include_once 'OperationFactory.php';
class Functions {
    private OperationHandler $handler;

    public function __construct(string $operation) {
        $handler = OperationFactory::getHandler($operation);
        if (!$handler) {
            throw new InvalidArgumentException("Unknown operation: $operation");
        }
        $this->handler = $handler;
    }

    public function run(string $input): mixed {
        $sanitized = $this->handler->sanitize($input);
        return $this->handler->execute($sanitized);
    }
}
