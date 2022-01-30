<?php

declare (strict_types=1);
namespace Symplify\EasyCI\Psr4\RobotLoader;

use EasyCI20220130\Nette\Loaders\RobotLoader;
final class PhpClassLoader
{
    /**
     * @param string[] $directories
     * @return array<string, string>
     */
    public function load(array $directories) : array
    {
        $robotLoader = new \EasyCI20220130\Nette\Loaders\RobotLoader();
        $robotLoader->addDirectory(...$directories);
        $robotLoader->setTempDirectory(\sys_get_temp_dir() . '/migrify_psr4_switcher');
        $robotLoader->ignoreDirs[] = 'bin';
        $robotLoader->ignoreDirs[] = 'tests';
        $robotLoader->ignoreDirs[] = 'Fixture';
        $robotLoader->ignoreDirs[] = 'Source';
        $robotLoader->rebuild();
        return $robotLoader->getIndexedClasses();
    }
}