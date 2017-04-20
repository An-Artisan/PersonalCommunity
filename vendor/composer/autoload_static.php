<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit15ee9dbe31b59c5ecbb2f1f732417102
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\composer\\' => 15,
            'think\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'think\\' => 
        array (
            0 => __DIR__ . '/../..' . '/thinkphp/library/think',
            1 => __DIR__ . '/..' . '/topthink/think-image/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit15ee9dbe31b59c5ecbb2f1f732417102::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit15ee9dbe31b59c5ecbb2f1f732417102::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
