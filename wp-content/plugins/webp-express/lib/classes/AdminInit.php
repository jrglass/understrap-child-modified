<?php

namespace WebPExpress;

use \WebPExpress\Config;
use \WebPExpress\State;
use \WebPExpress\Option;
use \WebPExpress\Multisite;

/**
 *
 */

class AdminInit
{
    public static function init() {

        self::runMigrationIfNeeded();

        // uncomment next line to debug an error during activation
        //include __DIR__ . "/../debug.php";

        if (Option::getOption('webp-express-actions-pending')) {
            \WebPExpress\Actions::processQueuedActions();
        }

        self::addHooks();
    }

    public static function runMigrationIfNeeded()
    {
        // When an update requires a migration, the number should be increased
        define('WEBPEXPRESS_MIGRATION_VERSION', '8');

        if (WEBPEXPRESS_MIGRATION_VERSION != Option::getOption('webp-express-migration-version', 0)) {
            // run migration logic
            include WEBPEXPRESS_PLUGIN_DIR . '/lib/migrate/migrate.php';
        }

        // uncomment next line to test-run a migration
        //include WEBPEXPRESS_PLUGIN_DIR . '/lib/migrate/migrate8.php';
    }

    public static function adminInitHandler()
    {
        global $pagenow;
        if ((('options-general.php' === $pagenow) || (('settings.php' === $pagenow)))  && (isset($_GET['page'])) && ('webp_express_settings_page' === $_GET['page'])) {
            add_action('admin_enqueue_scripts', array('\WebPExpress\OptionsPage', 'enqueueScripts'));
        }
    }

    public static function addHooks()
    {

        // Plugin activation, deactivation and uninstall
        register_activation_hook(WEBPEXPRESS_PLUGIN, array('\WebPExpress\PluginActivate', 'activate'));
        register_deactivation_hook(WEBPEXPRESS_PLUGIN, array('\WebPExpress\PluginDeactivate', 'deactivate'));
        register_uninstall_hook(WEBPEXPRESS_PLUGIN, array('\WebPExpress\PluginUninstall', 'uninstall'));

        // Hooks related to options page
        if (Multisite::isNetworkActivated()) {
            add_action("network_admin_menu", array('\WebPExpress\AdminUi', 'networAdminMenuHook'));
        } else {
            add_action("admin_menu", array('\WebPExpress\AdminUi', 'adminMenuHook'));
        }
        add_action("admin_post_webpexpress_settings_submit", array('\WebPExpress\OptionsPageHooks', 'submitHandler'));
        add_action("admin_init", array('\WebPExpress\AdminInit', 'adminInitHandler'));

        // Print pending messages, if any
        if (Option::getOption('webp-express-messages-pending')) {
            add_action(Multisite::isNetworkActivated() ? 'network_admin_notices' : 'admin_notices', array('\WebPExpress\Messenger', 'printPendingMessages'));
        }

        // Add settings link on the plugins page
        add_filter('plugin_action_links_' . plugin_basename(WEBPEXPRESS_PLUGIN), array('\WebPExpress\AdminUi', 'pluginActionLinksFilter'), 10, 2);

        // Add settings link in multisite
        add_filter('network_admin_plugin_action_links_' . plugin_basename(WEBPEXPRESS_PLUGIN), array('\WebPExpress\AdminUi', 'networkPluginActionLinksFilter'), 10, 2);

        // Ajax actions
        add_action('wp_ajax_list_unconverted_files', array('\WebPExpress\BulkConvert', 'processAjaxListUnconvertedFiles'));
        add_action('wp_ajax_convert_file', array('\WebPExpress\BulkConvert', 'processAjaxConvertFile'));
        add_action('wp_ajax_webpexpress_purge_cache', array('\WebPExpress\CachePurge', 'processAjaxPurgeCache'));

        // PS:
        // Filters for processing upload hooks in order to convert images upon upload (wp_handle_upload / image_make_intermediate_size)
        // are located in webp-express.php

    }
}
