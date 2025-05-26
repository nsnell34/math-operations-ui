<?php

class TypedValue {
    public mixed $value;
    public string $type;

    public function __construct(mixed $value, string $type) {
        $this->value = $value;
        $this->type = $type;
    }
}
