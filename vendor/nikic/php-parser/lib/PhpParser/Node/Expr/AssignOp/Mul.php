<?php

declare (strict_types=1);
namespace EasyCI20220127\PhpParser\Node\Expr\AssignOp;

use EasyCI20220127\PhpParser\Node\Expr\AssignOp;
class Mul extends \EasyCI20220127\PhpParser\Node\Expr\AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Mul';
    }
}
