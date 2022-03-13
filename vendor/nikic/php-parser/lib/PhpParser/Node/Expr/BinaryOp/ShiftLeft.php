<?php

declare (strict_types=1);
namespace EasyCI20220313\PhpParser\Node\Expr\BinaryOp;

use EasyCI20220313\PhpParser\Node\Expr\BinaryOp;
class ShiftLeft extends \EasyCI20220313\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '<<';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_ShiftLeft';
    }
}
