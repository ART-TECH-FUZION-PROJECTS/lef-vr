<?php
/**
 * DB Schema for Listing Engine Frontend.
 * (Currently managed by external plugin)
 *
 * @package ListingEngineFrontend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get schema definitions for listing engine tables.
 *
 * @return array Table schemas mapped by table name.
 */
function lef_get_db_schemas() {
	global $wpdb;
    
	$charset_collate = $wpdb->get_charset_collate();

	$reservation_table = $wpdb->prefix . 'ls_reservation';
	$reviews_table     = $wpdb->prefix . 'ls_reviews';
	$wishlist_table    = $wpdb->prefix . 'ls_wishlist';

	// ─────────────────────────────────────────────────────────────
	// Define all required tables and their CREATE queries.
	// The DB handler reads these dynamically via dbDelta.
	// ─────────────────────────────────────────────────────────────
	$schemas = array(

		/* ==================== RESERVATION TABLE ==================== */
		$reservation_table => "CREATE TABLE {$reservation_table} (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            property_id bigint(20) unsigned NOT NULL,
            reserve_date text NOT NULL,
            reservation_number varchar(100) NOT NULL,
            total_guests text NOT NULL,
            total_price decimal(10,2) NOT NULL,
            status varchar(20) NOT NULL DEFAULT 'pending',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;",

		/* ==================== REVIEWS TABLE ==================== */
        $reviews_table => "CREATE TABLE {$reviews_table} (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            property_id bigint(20) unsigned NOT NULL,
            rating decimal(3,1) NOT NULL,
            review text NOT NULL,
            status varchar(20) NOT NULL DEFAULT 'pending',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;",

		/* ==================== WISHLIST TABLE ==================== */
		$wishlist_table => "CREATE TABLE {$wishlist_table} (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            property_id bigint(20) unsigned NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;"
	);

	return $schemas;
}
