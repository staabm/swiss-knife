<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace EasyCI20220130\Symfony\Component\DependencyInjection\Argument;

use EasyCI20220130\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use EasyCI20220130\Symfony\Component\DependencyInjection\Reference;
/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Nicolas Grekas <p@tchwork.com>
 */
trait ReferenceSetArgumentTrait
{
    /**
     * @var mixed[]
     */
    private $values;
    /**
     * @param Reference[] $values
     */
    public function __construct(array $values)
    {
        $this->setValues($values);
    }
    /**
     * @return Reference[]
     */
    public function getValues() : array
    {
        return $this->values;
    }
    /**
     * @param Reference[] $values The service references to put in the set
     */
    public function setValues(array $values)
    {
        foreach ($values as $k => $v) {
            if (null !== $v && !$v instanceof \EasyCI20220130\Symfony\Component\DependencyInjection\Reference) {
                throw new \EasyCI20220130\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('A "%s" must hold only Reference instances, "%s" given.', __CLASS__, \get_debug_type($v)));
            }
        }
        $this->values = $values;
    }
}