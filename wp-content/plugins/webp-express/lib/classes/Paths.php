<?php

namespace WebPExpress;

use \WebPExpress\FileHelper;
use \WebPExpress\Multisite;
use \WebPExpress\PathHelper;

class Paths
{

    public static function createDirIfMissing($dir)
    {
        if (!@file_exists($dir)) {
            // We use the wp_mkdir_p, because it takes care of setting folder
            // permissions to that of parent, and handles creating deep structures too
            wp_mkdir_p($dir);
        }
        return file_exists($dir);
    }

    /**
    *  Find out if $dir1 is inside - or equal to - $dir2
    */
    public static function isDirInsideDir($dir1, $dir2)
    {
        $rel = PathHelper::getRelDir($dir2, $dir1);
        return (substr($rel, 0, 3) != '../');
    }

    /**
     *  Return relative dir - relative to realpath(document root)
     */
    public static function getRelDir($dir)
    {
        return PathHelper::getRelDir(realpath($_SERVER['DOCUMENT_ROOT']), $dir);
    }


    /**
     *  Return absolute dir.
     *  - realpath() is used to resolve soft links and resolve '../' and './'
     *  - trailing dash is removed - we don't use that around here.
     *
     *  realpath() only works on existing dirs.
     *  If realpath fails, PathHelper::canonicalize() will be used insead.
     *  (this takes care of resolving '../' and './', but does NOT resolve soft links)
     */
    public static function getAbsDir($dir)
    {
        $result = realpath($dir);
        if ($result === false) {
            $dir = PathHelper::canonicalize($dir);
        } else {
            $dir = $result;
        }
        return rtrim($dir, '/');
    }

    // ------------ Document Root -------------

    public static function getDocumentRootAbs()
    {
        return self::getAbsDir($_SERVER["DOCUMENT_ROOT"]);
    }

    // ------------ Home Dir -------------

    public static function getHomeDirAbs()
    {
        if (!function_exists('get_home_path')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }
        return self::getAbsDir(get_home_path());
    }

    public static function getHomeDirRel()
    {
        return self::getRelDir(self::getHomeDirAbs());
    }

    // ------------ Index Dir  -------------
    // (The Wordpress installation dir)

    public static function getIndexDirAbs()
    {
        return self::getAbsDir(ABSPATH);
    }

    public static function getIndexDirRel()
    {
        return self::getRelDir(self::getIndexDirAbs());
    }


    // ------------ .htaccess dir -------------
    // (directory containing the relevant .htaccess)
    // (see https://github.com/rosell-dk/webp-express/issues/36)



    public static function canWriteHTAccessRulesHere($dirName) {
        return FileHelper::canEditOrCreateFileHere($dirName . '/.htaccess');
    }

    public static function returnFirstWritableHTAccessDir($dirs)
    {
        foreach ($dirs as $dir) {
            if (self::canWriteHTAccessRulesHere($dir)) {
                return $dir;
            }
        }
        return false;
    }

    // ------------ Content Dir (the "WP" content dir) -------------

    public static function getContentDirAbs()
    {
        return self::getAbsDir(WP_CONTENT_DIR);
    }
    public static function getContentDirRel()
    {
        return self::getRelDir(self::getContentDirAbs());
    }

    public static function isWPContentDirMoved()
    {
        return (self::getContentDirAbs() != (ABSPATH . 'wp-content'));
    }

    public static function isWPContentDirMovedOutOfAbsPath()
    {
        return !(self::isDirInsideDir(self::getContentDirAbs(), ABSPATH));
    }


    // ------------ WebPExpress Content Dir -------------
    // (the "webp-express" directory inside wp-content)

    public static function getWebPExpressContentDirAbs()
    {
        return self::getContentDirAbs() . '/webp-express';
    }

    public static function getWebPExpressContentDirRel()
    {
        return self::getRelDir(self::getWebPExpressContentDirAbs());
    }

    public static function createContentDirIfMissing()
    {
        return self::createDirIfMissing(self::getWebPExpressContentDirAbs());
    }

    // ------------ Upload Dir -------------
    public static function getUploadDirAbs()
    {
        $upload_dir = wp_upload_dir(null, false);
        return self::getAbsDir($upload_dir['basedir']);
    }
    public static function getUploadDirRel()
    {
        return self::getRelDir(self::getUploadDirAbs());
    }

    /*
    public static function getUploadDirAbs()
    {
        if ( defined( 'UPLOADS' ) ) {
            return ABSPATH . rtrim(UPLOADS, '/');
        } else {
            return self::getContentDirAbs() . '/uploads';
        }
    }*/

    public static function isUploadDirMovedOutOfWPContentDir()
    {
        return !(self::isDirInsideDir(self::getUploadDirAbs(), self::getContentDirAbs()));
    }

    public static function isUploadDirMovedOutOfAbsPath()
    {
        return !(self::isDirInsideDir(self::getUploadDirAbs(), ABSPATH));
    }

    // ------------ Config Dir -------------

    public static function getConfigDirAbs()
    {
        return self::getWebPExpressContentDirAbs() . '/config';
    }

    public static function getConfigDirRel()
    {
        return self::getRelDir(self::getConfigDirAbs());
    }

    public static function createConfigDirIfMissing()
    {
        $configDir = self::getConfigDirAbs();
        // Using code from Wordfence bootstrap.php...
        // Why not simply use wp_mkdir_p ? - it sets the permissions to same as parent. Isn't that better?
        // or perhaps not... - Because we need write permissions in the config dir.
        if (!is_dir($configDir)) {
            @mkdir($configDir, 0775);
            @chmod($configDir, 0775);
            @file_put_contents(rtrim($configDir . '/') . '/.htaccess', <<<APACHE
<IfModule mod_authz_core.c>
Require all denied
</IfModule>
<IfModule !mod_authz_core.c>
Order deny,allow
Deny from all
</IfModule>
APACHE
            );
            @chmod($configDir . '/.htaccess', 0664);
        }
        return is_dir($configDir);
    }

    public static function getConfigFileName()
    {
        return self::getConfigDirAbs() . '/config.json';
    }

    public static function getWodOptionsFileName()
    {
        return self::getConfigDirAbs() . '/wod-options.json';
    }

    // ------------ Cache Dir -------------

    public static function getCacheDirAbs()
    {
        return self::getWebPExpressContentDirAbs() . '/webp-images';
    }

    public static function getCacheDirRel()
    {
        return self::getRelDir(self::getCacheDirAbs());
    }

    public static function createCacheDirIfMissing()
    {
        return self::createDirIfMissing(self::getCacheDirAbs());
    }

    // ------------ Plugin Dir (all plugins) -------------

    public static function getPluginDirAbs()
    {
        return self::getAbsDir(WP_PLUGIN_DIR);
    }

    public static function getPluginDirRel()
    {
        return self::getRelDir(self::getPluginDirAbs());
    }

    public static function isPluginDirMovedOutOfAbsPath()
    {
        return !(self::isDirInsideDir(self::getPluginDirAbs(), ABSPATH));
    }

    public static function isPluginDirMovedOutOfWpContent()
    {
        return !(self::isDirInsideDir(self::getPluginDirAbs(), self::getContentDirAbs()));
    }

    // ------------ WebP Express Plugin Dir -------------

    public static function getWebPExpressPluginDirAbs()
    {
        return self::getAbsDir(WEBPEXPRESS_PLUGIN_DIR);
    }

    public static function getAbsDirId($absDir) {
        switch ($absDir) {
            case self::getContentDirAbs():
                return 'wp-content';
            case self::getIndexDirAbs():
                return 'index';
            case self::getHomeDirAbs():
                return 'home';
            case self::getPluginDirAbs():
                return 'plugins';
            case self::getUploadDirAbs():
                return 'uploads';
        }
        return false;
    }

    public static function getAbsDirById($dirId) {
        switch ($dirId) {
            case 'wp-content':
                return self::getContentDirAbs();
            case 'index':
                return self::getIndexDirAbs();
            case 'home':
                return self::getHomeDirAbs();
            case 'plugins':
                return self::getPluginDirAbs();
            case 'uploads':
                return self::getUploadDirAbs();
        }
        return false;
    }


    // ------------------------------------
    // ---------    Url paths    ----------
    // ------------------------------------

    /**
     *  Get url path (relative to domain) from absolute url.
     *  Ie: "http://example.com/blog" => "blog"
     *  Btw: By "url path" we shall always mean relative to domain
     *       By "url" we shall always mean complete URL (with domain and everything)
     *                                (or at least something that starts with it...)
     *
     *  Also note that in this library, we never returns trailing or leading slashes.
     */
    public static function getUrlPathFromUrl($url)
    {
        $parsed = parse_url($url);
        if (!isset($parsed['path'])) {
            return '';
        }
        if (is_null($parsed['path'])) {
            return '';
        }
        $path = untrailingslashit($parsed['path']);
        return ltrim($path, '/\\');
    }

    // Get complete home url (no trailing slash). Ie: "http://example.com/blog"
    public static function getHomeUrl()
    {
        if (!function_exists('get_home_url')) {
            // silence is golden?
        }
        return untrailingslashit(home_url());
    }

    /** Get home url, relative to domain. Ie "" or "blog"
     *  If home url is for example http://example.com/blog/, the result is "blog"
     */
    public static function getHomeUrlPath()
    {
        return self::getUrlPathFromUrl(self::getHomeUrl());
    }


    public static function getUploadUrl()
    {
        $uploadDir = wp_upload_dir(null, false);
        return untrailingslashit($uploadDir['baseurl']);
    }

    public static function getUploadUrlPath()
    {
        return self::getUrlPathFromUrl(self::getUploadUrl());
    }

    public static function getContentUrl()
    {
        return untrailingslashit(content_url());
    }

    public static function getContentUrlPath()
    {
        return self::getUrlPathFromUrl(self::getContentUrl());
    }




    /**
     *  Get Url to WebP Express plugin (this is in fact an incomplete URL, you need to append ie '/webp-on-demand.php' to get a full URL)
     */
    public static function getPluginUrl()
    {
        return untrailingslashit(plugins_url('', WEBPEXPRESS_PLUGIN));
    }

    public static function getPluginUrlPath()
    {
        return self::getUrlPathFromUrl(self::getPluginUrl());
    }

    public static function getWodUrlPath()
    {
        return self::getPluginUrlPath() . '/wod/webp-on-demand.php';
    }

    public static function getWebPRealizerUrlPath()
    {
        return self::getPluginUrlPath() . '/wod/webp-realizer.php';
    }

    public static function getWebServiceUrl()
    {
        //return self::getPluginUrl() . '/wpc.php';
        //return self::getHomeUrl() . '/webp-express-server';
        return self::getHomeUrl() . '/webp-express-web-service';
    }

    /**
     *  Calculate path to existing image, excluding
     *  (relative to document root)
     *  Ie: "/webp-express-test/wordpress/wp-content/webp-express/webp-images/webp-express-test/wordpress/"
     *  This is needed for the .htaccess
     */
    public static function getPathToExisting()
    {
        return self::getCacheDirRel() . '/doc-root/' . self::getHomeDirRel();
    }

    public static function getUrlsAndPathsForTheJavascript()
    {
        return [
            'urls' => [
                'webpExpressRoot' => self::getPluginUrlPath(),
            ],
            'filePaths' => [
                'webpExpressRoot' => self::getWebPExpressPluginDirAbs(),
                'destinationRoot' => self::getCacheDirAbs(),
                'configRelToDocRoot' => self::getConfigDirRel()
            ]
        ];
    }

    public static function getSettingsUrl()
    {
        if (!function_exists('admin_url')) {
            require_once ABSPATH . 'wp-includes/link-template.php';
        }
        if (Multisite::isNetworkActivated()) {
            // network_admin_url is also defined in link-template.php.
            return network_admin_url('settings.php?page=webp_express_settings_page');
        } else {
            return admin_url('options-general.php?page=webp_express_settings_page');
        }
    }

}
