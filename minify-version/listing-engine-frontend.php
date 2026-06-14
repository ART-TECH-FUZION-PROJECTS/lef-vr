<?php

/**
 * Plugin Name: Listing Engine Frontend
 * Plugin URI: https://arttechfuzion.com
 * Description: A vacation rental listing and booking plugin with property search, curated listing views, single-property pages, wishlists, reviews, reservations, user dashboards, and admin reservation management.
 * Version:     2.4.23
 * Author:      Art-Tech Fuzion
 * Author URI:  https://arttechfuzion.com
 * Text Domain: listing-engine-frontend
 *
 * @package ListingEngineFrontend
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Define Constants.
define('LEF_VERSION', '2.4.23');
define('LEF_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LEF_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Initialize Plugin.
 */
function lef_initialize_plugin()
{
	// Include Helpers.
	require_once LEF_PLUGIN_DIR . 'includes/helpers.php';

	// Include DB Schema.
	require_once LEF_PLUGIN_DIR . 'includes/db-schema.php';

	// Include Registry Hooks.
	require_once LEF_PLUGIN_DIR . 'includes/registery-hooks.php';

	// Include Asset Loader.
	require_once LEF_PLUGIN_DIR . 'includes/assets-loader.php';

	// Include URL Router.
	require_once LEF_PLUGIN_DIR . 'includes/url-router.php';

	// Include Shortcode Handler.
	require_once LEF_PLUGIN_DIR . 'includes/shortcode-handler.php';

	// Include AJAX Handler.
	require_once LEF_PLUGIN_DIR . 'includes/ajax-handler.php';

	// Include DB Handler.
	require_once LEF_PLUGIN_DIR . 'includes/class-db-handler.php';

	// Include Centralized Mail Controller.
	require_once LEF_PLUGIN_DIR . 'mails/mail-controller.php';
}
add_action('plugins_loaded', 'lef_initialize_plugin');

// ─────────────────────────────────────────────────────────────
// Plugin Setup
// ─────────────────────────────────────────────────────────────

/* ==================== ACTION LINKS ==================== */

/**
 * Add Settings link on the plugins page.
 *
 * @param array $links Array of plugin action links.
 * @return array
 */
function lef_add_plugin_action_links($links)
{
	$settings_link = '<a href="' . admin_url('admin.php?page=lef-dashboard') . '">' . __('Settings', 'listing-engine-frontend') . '</a>';
	array_unshift($links, $settings_link);
	return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'lef_add_plugin_action_links');