<?php

use MathParser\Parsing\Nodes\ExpressionNode;
use MathParser\Parsing\Nodes\VariableNode;
use MathParser\Parsing\Nodes\NumberNode;
use MathParser\Parsing\Nodes\FunctionCallNode;

class Parser
{
    public array $terms = [];

    public function __construct($ast)
    {
        $this->extractTerms($ast);
    }

    public function extractTerms($node)
    {
        if ($node instanceof ExpressionNode) {
            $this->extractTerms($this->getPrivateProperty($node, 'left'));
            $this->extractTerms($this->getPrivateProperty($node, 'right'));
        } elseif ($node instanceof VariableNode) {
            $this->terms[] = $this->getPrivateProperty($node, 'name');
        } elseif ($node instanceof NumberNode) {
            $this->terms[] = $this->getPrivateProperty($node, 'value');
        } elseif ($node instanceof FunctionCallNode) {
            $this->terms[] = $this->getPrivateProperty($node, 'name');
            $args = $this->getPrivateProperty($node, 'args');
            foreach ($args as $arg) {
                $this->extractTerms($arg);
            }
        }
    }

    private function getPrivateProperty($object, $property)
    {
        $reflection = new ReflectionClass($object);
        $prop = $reflection->getProperty($property);
        $prop->setAccessible(true);
        return $prop->getValue($object);
    }
}
