<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbebd7411968e949c566a9eadbc99b70b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayMaya' => 
            array (
                0 => __DIR__ . '/..' . '/paymaya/paymaya-sdk/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbebd7411968e949c566a9eadbc99b70b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbebd7411968e949c566a9eadbc99b70b::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbebd7411968e949c566a9eadbc99b70b::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitbebd7411968e949c566a9eadbc99b70b::$classMap;

        }, null, ClassLoader::class);
    }
}
