<?php

declare (strict_types=1);
namespace EasyCI20220130\Symplify\Astral\NodeTraverser;

use EasyCI20220130\PhpParser\Node;
use EasyCI20220130\PhpParser\NodeTraverser;
use EasyCI20220130\Symplify\Astral\NodeVisitor\CallableNodeVisitor;
/**
 * @api
 */
final class SimpleCallableNodeTraverser
{
    /**
     * @param mixed[]|\PhpParser\Node|null $nodes
     */
    public function traverseNodesWithCallable($nodes, callable $callable) : void
    {
        if ($nodes === null) {
            return;
        }
        if ($nodes === []) {
            return;
        }
        if (!\is_array($nodes)) {
            $nodes = [$nodes];
        }
        $nodeTraverser = new \EasyCI20220130\PhpParser\NodeTraverser();
        $callableNodeVisitor = new \EasyCI20220130\Symplify\Astral\NodeVisitor\CallableNodeVisitor($callable);
        $nodeTraverser->addVisitor($callableNodeVisitor);
        $nodeTraverser->traverse($nodes);
    }
}