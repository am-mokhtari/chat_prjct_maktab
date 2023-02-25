<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite5d6fad7a04db68fc774c4d0999509f9
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite5d6fad7a04db68fc774c4d0999509f9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite5d6fad7a04db68fc774c4d0999509f9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite5d6fad7a04db68fc774c4d0999509f9::$classMap;

        }, null, ClassLoader::class);
    }
}