<?php

declare (strict_types=1);
namespace EasyCI202210\PhpParser\Node\Expr\Cast;

use EasyCI202210\PhpParser\Node\Expr\Cast;
class Int_ extends Cast
{
    public function getType() : string
    {
        return 'Expr_Cast_Int';
    }
}
