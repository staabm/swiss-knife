<?php

declare (strict_types=1);
namespace EasyCI20220130\PhpParser\Node\Stmt;

use EasyCI20220130\PhpParser\Node;
use EasyCI20220130\PhpParser\Node\ComplexType;
use EasyCI20220130\PhpParser\Node\Identifier;
use EasyCI20220130\PhpParser\Node\Name;
class Property extends \EasyCI20220130\PhpParser\Node\Stmt
{
    /** @var int Modifiers */
    public $flags;
    /** @var PropertyProperty[] Properties */
    public $props;
    /** @var null|Identifier|Name|ComplexType Type declaration */
    public $type;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public $attrGroups;
    /**
     * Constructs a class property list node.
     *
     * @param int                                     $flags      Modifiers
     * @param PropertyProperty[]                      $props      Properties
     * @param array                                   $attributes Additional attributes
     * @param null|string|Identifier|Name|ComplexType $type       Type declaration
     * @param Node\AttributeGroup[]                   $attrGroups PHP attribute groups
     */
    public function __construct(int $flags, array $props, array $attributes = [], $type = null, array $attrGroups = [])
    {
        $this->attributes = $attributes;
        $this->flags = $flags;
        $this->props = $props;
        $this->type = \is_string($type) ? new \EasyCI20220130\PhpParser\Node\Identifier($type) : $type;
        $this->attrGroups = $attrGroups;
    }
    public function getSubNodeNames() : array
    {
        return ['attrGroups', 'flags', 'type', 'props'];
    }
    /**
     * Whether the property is explicitly or implicitly public.
     *
     * @return bool
     */
    public function isPublic() : bool
    {
        return ($this->flags & \EasyCI20220130\PhpParser\Node\Stmt\Class_::MODIFIER_PUBLIC) !== 0 || ($this->flags & \EasyCI20220130\PhpParser\Node\Stmt\Class_::VISIBILITY_MODIFIER_MASK) === 0;
    }
    /**
     * Whether the property is protected.
     *
     * @return bool
     */
    public function isProtected() : bool
    {
        return (bool) ($this->flags & \EasyCI20220130\PhpParser\Node\Stmt\Class_::MODIFIER_PROTECTED);
    }
    /**
     * Whether the property is private.
     *
     * @return bool
     */
    public function isPrivate() : bool
    {
        return (bool) ($this->flags & \EasyCI20220130\PhpParser\Node\Stmt\Class_::MODIFIER_PRIVATE);
    }
    /**
     * Whether the property is static.
     *
     * @return bool
     */
    public function isStatic() : bool
    {
        return (bool) ($this->flags & \EasyCI20220130\PhpParser\Node\Stmt\Class_::MODIFIER_STATIC);
    }
    /**
     * Whether the property is readonly.
     *
     * @return bool
     */
    public function isReadonly() : bool
    {
        return (bool) ($this->flags & \EasyCI20220130\PhpParser\Node\Stmt\Class_::MODIFIER_READONLY);
    }
    public function getType() : string
    {
        return 'Stmt_Property';
    }
}