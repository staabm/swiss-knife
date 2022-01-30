<?php

declare (strict_types=1);
namespace EasyCI20220130\Symplify\Astral\NodeNameResolver;

use EasyCI20220130\PhpParser\Node;
use EasyCI20220130\PhpParser\Node\Stmt\Namespace_;
use EasyCI20220130\Symplify\Astral\Contract\NodeNameResolverInterface;
final class NamespaceNodeNameResolver implements \EasyCI20220130\Symplify\Astral\Contract\NodeNameResolverInterface
{
    public function match(\EasyCI20220130\PhpParser\Node $node) : bool
    {
        return $node instanceof \EasyCI20220130\PhpParser\Node\Stmt\Namespace_;
    }
    /**
     * @param Namespace_ $node
     */
    public function resolve(\EasyCI20220130\PhpParser\Node $node) : ?string
    {
        if ($node->name === null) {
            return null;
        }
        return $node->name->toString();
    }
}