<?php

declare (strict_types=1);
namespace Symplify\EasyCI\Testing;

use Symplify\EasyCI\Testing\Autoloading\DualTestCaseAuloader;
use Symplify\EasyCI\Testing\Finder\TestCaseClassFinder;
/**
 * @see \Symplify\EasyCI\Tests\Testing\UnitTestFilePathsFinder\UnitTestFilePathsFinderTest
 */
final class UnitTestFilePathsFinder
{
    /**
     * @var \Symplify\EasyCI\Testing\Autoloading\DualTestCaseAuloader
     */
    private $dualTestCaseAuloader;
    /**
     * @var \Symplify\EasyCI\Testing\Finder\TestCaseClassFinder
     */
    private $testCaseClassFinder;
    /**
     * @var \Symplify\EasyCI\Testing\UnitTestFilter
     */
    private $unitTestFilter;
    public function __construct(\Symplify\EasyCI\Testing\Autoloading\DualTestCaseAuloader $dualTestCaseAuloader, \Symplify\EasyCI\Testing\Finder\TestCaseClassFinder $testCaseClassFinder, \Symplify\EasyCI\Testing\UnitTestFilter $unitTestFilter)
    {
        $this->dualTestCaseAuloader = $dualTestCaseAuloader;
        $this->testCaseClassFinder = $testCaseClassFinder;
        $this->unitTestFilter = $unitTestFilter;
    }
    /**
     * @param string[] $directories
     * @return array<string, string>
     */
    public function findInDirectories(array $directories) : array
    {
        $this->dualTestCaseAuloader->autoload();
        $testsCasesClassesToFilePaths = $this->testCaseClassFinder->findInDirectories($directories);
        return $this->unitTestFilter->filter($testsCasesClassesToFilePaths);
    }
}