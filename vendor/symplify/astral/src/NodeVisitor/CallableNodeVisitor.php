<?php

declare (strict_types=1);
namespace EasyCI20220130\Symplify\Astral\NodeVisitor;

use EasyCI20220130\PhpParser\Node;
use EasyCI20220130\PhpParser\Node\Expr;
use EasyCI20220130\PhpParser\Node\Stmt;
use EasyCI20220130\PhpParser\Node\Stmt\Expression;
use EasyCI20220130\PhpParser\NodeVisitorAbstract;
final class CallableNodeVisitor extends \EasyCI20220130\PhpParser\NodeVisitorAbstract
{
    /**
     * @var callable
     */
    private $callable;
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }
    /**
     * @return int|Node|null
     */
    public function enterNode(\EasyCI20220130\PhpParser\Node $node)
    {
        $originalNode = $node;
        $callable = $this->callable;
        /** @var int|Node|null $newNode */
        $newNode = $callable($node);
        if ($originalNode instanceof \EasyCI20220130\PhpParser\Node\Stmt && $newNode instanceof \EasyCI20220130\PhpParser\Node\Expr) {
            return new \EasyCI20220130\PhpParser\Node\Stmt\Expression($newNode);
        }
        return $newNode;
    }
}