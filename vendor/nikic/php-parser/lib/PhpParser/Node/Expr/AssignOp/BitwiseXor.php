<?php

declare (strict_types=1);
namespace EasyCI20220313\PhpParser\Node\Expr\AssignOp;

use EasyCI20220313\PhpParser\Node\Expr\AssignOp;
class BitwiseXor extends \EasyCI20220313\PhpParser\Node\Expr\AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_BitwiseXor';
    }
}
