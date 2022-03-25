<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace EasyCI20220325\Symfony\Component\DependencyInjection\Compiler;

use EasyCI20220325\Symfony\Component\DependencyInjection\Definition;
use EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException;
/**
 * Checks if arguments of methods are properly configured.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @author Nicolas Grekas <p@tchwork.com>
 */
class CheckArgumentsValidityPass extends \EasyCI20220325\Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass
{
    /**
     * @var bool
     */
    private $throwExceptions;
    public function __construct(bool $throwExceptions = \true)
    {
        $this->throwExceptions = $throwExceptions;
    }
    /**
     * {@inheritdoc}
     * @param mixed $value
     * @return mixed
     */
    protected function processValue($value, bool $isRoot = \false)
    {
        if (!$value instanceof \EasyCI20220325\Symfony\Component\DependencyInjection\Definition) {
            return parent::processValue($value, $isRoot);
        }
        $i = 0;
        $hasNamedArgs = \false;
        foreach ($value->getArguments() as $k => $v) {
            if (\preg_match('/^[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*$/', $k)) {
                $hasNamedArgs = \true;
                continue;
            }
            if ($k !== $i++) {
                if (!\is_int($k)) {
                    $msg = \sprintf('Invalid constructor argument for service "%s": integer expected but found string "%s". Check your service definition.', $this->currentId, $k);
                    $value->addError($msg);
                    if ($this->throwExceptions) {
                        throw new \EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException($msg);
                    }
                    break;
                }
                $msg = \sprintf('Invalid constructor argument %d for service "%s": argument %d must be defined before. Check your service definition.', 1 + $k, $this->currentId, $i);
                $value->addError($msg);
                if ($this->throwExceptions) {
                    throw new \EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException($msg);
                }
            }
            if ($hasNamedArgs) {
                $msg = \sprintf('Invalid constructor argument for service "%s": cannot use positional argument after named argument. Check your service definition.', $this->currentId);
                $value->addError($msg);
                if ($this->throwExceptions) {
                    throw new \EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException($msg);
                }
                break;
            }
        }
        foreach ($value->getMethodCalls() as $methodCall) {
            $i = 0;
            $hasNamedArgs = \false;
            foreach ($methodCall[1] as $k => $v) {
                if (\preg_match('/^[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*$/', $k)) {
                    $hasNamedArgs = \true;
                    continue;
                }
                if ($k !== $i++) {
                    if (!\is_int($k)) {
                        $msg = \sprintf('Invalid argument for method call "%s" of service "%s": integer expected but found string "%s". Check your service definition.', $methodCall[0], $this->currentId, $k);
                        $value->addError($msg);
                        if ($this->throwExceptions) {
                            throw new \EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException($msg);
                        }
                        break;
                    }
                    $msg = \sprintf('Invalid argument %d for method call "%s" of service "%s": argument %d must be defined before. Check your service definition.', 1 + $k, $methodCall[0], $this->currentId, $i);
                    $value->addError($msg);
                    if ($this->throwExceptions) {
                        throw new \EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException($msg);
                    }
                }
                if ($hasNamedArgs) {
                    $msg = \sprintf('Invalid argument for method call "%s" of service "%s": cannot use positional argument after named argument. Check your service definition.', $methodCall[0], $this->currentId);
                    $value->addError($msg);
                    if ($this->throwExceptions) {
                        throw new \EasyCI20220325\Symfony\Component\DependencyInjection\Exception\RuntimeException($msg);
                    }
                    break;
                }
            }
        }
        return null;
    }
}
