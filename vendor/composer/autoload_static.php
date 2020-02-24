<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb5857c95bf9b45e143be452dfa629ba9
{
    public static $files = array (
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Panglongxia\\MongoTest\\' => 22,
        ),
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Panglongxia\\MongoTest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb5857c95bf9b45e143be452dfa629ba9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb5857c95bf9b45e143be452dfa629ba9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
