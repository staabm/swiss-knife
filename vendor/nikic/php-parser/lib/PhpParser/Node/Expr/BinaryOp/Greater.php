<?php

declare (strict_types=1);
namespace EasyCI20220127\PhpParser\Node\Expr\BinaryOp;

use EasyCI20220127\PhpParser\Node\Expr\BinaryOp;
class Greater extends \EasyCI20220127\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '>';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Greater';
    }
}
