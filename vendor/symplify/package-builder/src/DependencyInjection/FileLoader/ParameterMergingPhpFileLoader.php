<?php

declare (strict_types=1);
namespace EasyCI20220130\Symplify\PackageBuilder\DependencyInjection\FileLoader;

use EasyCI20220130\Symfony\Component\Config\FileLocatorInterface;
use EasyCI20220130\Symfony\Component\DependencyInjection\ContainerBuilder;
use EasyCI20220130\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use EasyCI20220130\Symplify\PackageBuilder\Yaml\ParametersMerger;
/**
 * @api
 *
 * The need:
 * - https://github.com/symfony/symfony/issues/26713
 * - https://github.com/symfony/symfony/pull/21313#issuecomment-372037445
 *
 * @property ContainerBuilder $container
 */
final class ParameterMergingPhpFileLoader extends \EasyCI20220130\Symfony\Component\DependencyInjection\Loader\PhpFileLoader
{
    /**
     * @var \Symplify\PackageBuilder\Yaml\ParametersMerger
     */
    private $parametersMerger;
    public function __construct(\EasyCI20220130\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, \EasyCI20220130\Symfony\Component\Config\FileLocatorInterface $fileLocator)
    {
        $this->parametersMerger = new \EasyCI20220130\Symplify\PackageBuilder\Yaml\ParametersMerger();
        parent::__construct($containerBuilder, $fileLocator);
    }
    /**
     * Same as parent, just merging parameters instead overriding them
     *
     * @see https://github.com/symplify/symplify/pull/697
     * @param mixed $resource
     * @return mixed
     * @param string|null $type
     */
    public function load($resource, $type = null)
    {
        // get old parameters
        $parameterBag = $this->container->getParameterBag();
        $oldParameters = $parameterBag->all();
        parent::load($resource);
        foreach ($oldParameters as $key => $oldValue) {
            $currentParameterValue = $this->container->getParameter($key);
            $newValue = $this->parametersMerger->merge($oldValue, $currentParameterValue);
            $this->container->setParameter($key, $newValue);
        }
        return null;
    }
}