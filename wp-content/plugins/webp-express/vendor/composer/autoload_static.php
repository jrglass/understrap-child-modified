<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9a5d1d521aac5c1f4f08f3a90858f030
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WebPConvert\\' => 12,
            'WebPConvertCloudService\\' => 24,
        ),
        'D' => 
        array (
            'DOMUtilForWebP\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WebPConvert\\' => 
        array (
            0 => __DIR__ . '/..' . '/rosell-dk/webp-convert/src',
        ),
        'WebPConvertCloudService\\' => 
        array (
            0 => __DIR__ . '/..' . '/rosell-dk/webp-convert-cloud-service/src',
        ),
        'DOMUtilForWebP\\' => 
        array (
            0 => __DIR__ . '/..' . '/rosell-dk/dom-util-for-webp/src',
        ),
    );

    public static $classMap = array (
        'DOMUtilForWebP\\ImageUrlReplacer' => __DIR__ . '/..' . '/rosell-dk/dom-util-for-webp/src/ImageUrlReplacer.php',
        'DOMUtilForWebP\\PictureTags' => __DIR__ . '/..' . '/rosell-dk/dom-util-for-webp/src/PictureTags.php',
        'WebPConvertCloudService\\AccessCheck' => __DIR__ . '/..' . '/rosell-dk/webp-convert-cloud-service/src/AccessCheck.php',
        'WebPConvertCloudService\\Serve' => __DIR__ . '/..' . '/rosell-dk/webp-convert-cloud-service/src/Serve.php',
        'WebPConvertCloudService\\WebPConvertCloudService' => __DIR__ . '/..' . '/rosell-dk/webp-convert-cloud-service/src/WebPConvertCloudService.php',
        'WebPConvert\\Converters\\ConverterHelper' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/ConverterHelper.php',
        'WebPConvert\\Converters\\Cwebp' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Cwebp.php',
        'WebPConvert\\Converters\\Ewww' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Ewww.php',
        'WebPConvert\\Converters\\Exceptions\\ConversionDeclinedException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Exceptions/ConversionDeclinedException.php',
        'WebPConvert\\Converters\\Exceptions\\ConverterFailedException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Exceptions/ConverterFailedException.php',
        'WebPConvert\\Converters\\Exceptions\\ConverterNotOperationalException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Exceptions/ConverterNotOperationalException.php',
        'WebPConvert\\Converters\\Gd' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Gd.php',
        'WebPConvert\\Converters\\Gmagick' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Gmagick.php',
        'WebPConvert\\Converters\\Imagick' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Imagick.php',
        'WebPConvert\\Converters\\ImagickBinary' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Imagickbinary.php',
        'WebPConvert\\Converters\\Wpc' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Converters/Wpc.php',
        'WebPConvert\\Exceptions\\ConverterNotFoundException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Exceptions/ConverterNotFoundException.php',
        'WebPConvert\\Exceptions\\CreateDestinationFileException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Exceptions/CreateDestinationFileException.php',
        'WebPConvert\\Exceptions\\CreateDestinationFolderException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Exceptions/CreateDestinationFolderException.php',
        'WebPConvert\\Exceptions\\InvalidFileExtensionException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Exceptions/InvalidFileExtensionException.php',
        'WebPConvert\\Exceptions\\TargetNotFoundException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Exceptions/TargetNotFoundException.php',
        'WebPConvert\\Exceptions\\WebPConvertBaseException' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Exceptions/WebPConvertBaseException.php',
        'WebPConvert\\Loggers\\BaseLogger' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Loggers/BaseLogger.php',
        'WebPConvert\\Loggers\\BufferLogger' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Loggers/BufferLogger.php',
        'WebPConvert\\Loggers\\EchoLogger' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Loggers/EchoLogger.php',
        'WebPConvert\\Loggers\\VoidLogger' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Loggers/VoidLogger.php',
        'WebPConvert\\Serve\\Report' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Serve/Report.php',
        'WebPConvert\\Serve\\ServeBase' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Serve/ServeBase.php',
        'WebPConvert\\Serve\\ServeConverted' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Serve/ServeConverted.php',
        'WebPConvert\\Serve\\ServeExistingOrHandOver' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/Serve/ServeExistingOrHandOver.php',
        'WebPConvert\\WebPConvert' => __DIR__ . '/..' . '/rosell-dk/webp-convert/src/WebPConvert.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9a5d1d521aac5c1f4f08f3a90858f030::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9a5d1d521aac5c1f4f08f3a90858f030::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9a5d1d521aac5c1f4f08f3a90858f030::$classMap;

        }, null, ClassLoader::class);
    }
}
