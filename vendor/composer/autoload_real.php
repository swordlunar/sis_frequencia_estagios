<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfd55b4ff26f0a6e0f9f4f026bcc9419c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitfd55b4ff26f0a6e0f9f4f026bcc9419c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfd55b4ff26f0a6e0f9f4f026bcc9419c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfd55b4ff26f0a6e0f9f4f026bcc9419c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}