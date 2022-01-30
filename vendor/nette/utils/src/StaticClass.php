<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace EasyCI20220130\Nette;

/**
 * Static class.
 */
trait StaticClass
{
    /**
     * @return never
     * @throws \Error
     */
    public final function __construct()
    {
        throw new \Error('Class ' . static::class . ' is static and cannot be instantiated.');
    }
    /**
     * Call to undefined static method.
     * @return void
     * @throws MemberAccessException
     */
    public static function __callStatic(string $name, array $args)
    {
        \EasyCI20220130\Nette\Utils\ObjectHelpers::strictStaticCall(static::class, $name);
    }
}