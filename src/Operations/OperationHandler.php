<?php

namespace Operations;

interface OperationHandler {
    public function sanitize(string $input): mixed;
    public function execute(mixed $sanitizedInput): mixed;
}