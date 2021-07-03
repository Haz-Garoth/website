<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a732eba6b74d8f69f01464920f851b0
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sample\\' => 7,
        ),
        'P' => 
        array (
            'PayPalHttp\\' => 11,
            'PayPalCheckoutSdk\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sample\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypal-checkout-sdk/samples',
        ),
        'PayPalHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypalhttp/lib/PayPalHttp',
        ),
        'PayPalCheckoutSdk\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypal-checkout-sdk/lib/PayPalCheckoutSdk',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a732eba6b74d8f69f01464920f851b0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a732eba6b74d8f69f01464920f851b0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8a732eba6b74d8f69f01464920f851b0::$classMap;

        }, null, ClassLoader::class);
    }
}