<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc7145ec13651c5308bc4d0825f87b58f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc7145ec13651c5308bc4d0825f87b58f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc7145ec13651c5308bc4d0825f87b58f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc7145ec13651c5308bc4d0825f87b58f::$classMap;

        }, null, ClassLoader::class);
    }
}
