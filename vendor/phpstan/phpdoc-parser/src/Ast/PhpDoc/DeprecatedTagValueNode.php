<?php

declare (strict_types=1);
namespace EasyCI20220608\PHPStan\PhpDocParser\Ast\PhpDoc;

use EasyCI20220608\PHPStan\PhpDocParser\Ast\NodeAttributes;
use function trim;
class DeprecatedTagValueNode implements PhpDocTagValueNode
{
    use NodeAttributes;
    /** @var string (may be empty) */
    public $description;
    public function __construct(string $description)
    {
        $this->description = $description;
    }
    public function __toString() : string
    {
        return trim($this->description);
    }
}
