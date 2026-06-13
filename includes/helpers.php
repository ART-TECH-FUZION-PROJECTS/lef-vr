<?php
/**
 * Global Helper Functions for Listing Engine Frontend.
 *
 * This file contains standalone functions used across multiple templates
 * and components (Reviews, User Profiles) to prevent fatal redeclaration errors.
 *
 * @package ListingEngineFrontend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the full URL for a plugin image.
 *
 * @param string $image_name The name of the image (e.g. 'placeholder.png').
 * @return string Full image URL.
 */
function lef_get_image_url( $image_name ) {
	return esc_url( rtrim( LEF_PLUGIN_URL, '/' ) . '/images/' . ltrim( $image_name, '/' ) );
}

/**
 * Format a date string into "d F Y" (e.g., 25 December 2026).
 *
 * @param string $date_str The date string to format.
 * @return string Formatted date or empty string.
 */
function lef_format_review_date( $date_str ) {
	$ts = strtotime( $date_str );
	return $ts ? date( 'd F Y', $ts ) : '';
}

/**
 * Truncate a string to a specific character limit.
 *
 * @param string $text  The text to truncate.
 * @param int    $limit The character limit.
 * @return string Truncated text with ellipsis.
 */
function lef_truncate_review( $text, $limit ) {
	if ( mb_strlen( $text ) > $limit ) {
		return mb_substr( $text, 0, $limit ) . '...';
	}
	return $text;
}

/**
 * Render 5 SVG stars for a review score.
 *
 * @param float|int $rating The rating score (0-5).
 * @return string HTML for the 5 stars.
 */
function lef_render_review_stars( $rating ) {
	$rating = round( floatval( $rating ) );
	$rating = max( 0, min( 5, $rating ) );

	$filled_star   = '<svg viewBox="0 0 32 32" class="lef-star-filled"><path d="m15.1 1.58-4.13 8.88-9.86 1.27a1 1 0 0 0-.54 1.74l7.3 6.57-1.97 9.85a1 1 0 0 0 1.48 1.06l8.62-5 8.63 5a1 1 0 0 0 1.48-1.06l-1.97-9.85 7.3-6.57a1 1 0 0 0-.55-1.73l-9.86-1.28-4.12-8.88a1 1 0 0 0-1.82 0z" /></svg>';
	$outlined_star = '<svg viewBox="0 0 32 32" class="lef-star-outline"><path d="m15.1 1.58-4.13 8.88-9.86 1.27a1 1 0 0 0-.54 1.74l7.3 6.57-1.97 9.85a1 1 0 0 0 1.48 1.06l8.62-5 8.63 5a1 1 0 0 0 1.48-1.06l-1.97-9.85 7.3-6.57a1 1 0 0 0-.55-1.73l-9.86-1.28-4.12-8.88a1 1 0 0 0-1.82 0z" /></svg>';

	$stars_html = '';
	for ( $i = 0; $i < 5; $i++ ) {
		$stars_html .= ( $i < $rating ) ? $filled_star : $outlined_star;
	}
	return $stars_html;
}

/**
 * Robustly fetch user profile picture URL.
 *
 * @param int $user_id User ID.
 * @return string Profile picture URL.
 */
function lef_get_user_profile_pic( $user_id ) {
	$placeholder = lef_get_image_url('placeholder-avatar.png');

	if ( ! $user_id ) {
		return esc_url( $placeholder );
	}

	$pic_meta = get_user_meta( $user_id, 'profile_pic', true );
	$pic_url  = '';

	if ( ! empty( $pic_meta ) ) {
		if ( strpos( $pic_meta, '{' ) === 0 || strpos( $pic_meta, '[' ) === 0 ) {
			$pic_data = json_decode( $pic_meta, true );
			if ( is_array( $pic_data ) ) {
				$pic_url = isset( $pic_data['url'] ) ? $pic_data['url'] : ( isset( $pic_data['path'] ) ? $pic_data['path'] : '' );
			}
		}
		if ( empty( $pic_url ) && is_string( $pic_meta ) ) {
			$pic_url = trim( $pic_meta );
		}
	}

	if ( ! empty( $pic_url ) ) {
		// If it's a local URL, check if the file exists on the server
		$upload_dir = wp_upload_dir();
		$base_url   = $upload_dir['baseurl'];
		$base_path  = $upload_dir['basedir'];

		if ( strpos( $pic_url, $base_url ) === 0 ) {
			$relative_path = str_replace( $base_url, '', $pic_url );
			$full_path     = $base_path . $relative_path;
			
			if ( ! file_exists( $full_path ) ) {
				$pic_url = ''; // Force placeholder fallback
			}
		}
	}

	return empty( $pic_url ) ? esc_url( $placeholder ) : esc_url( $pic_url );
}

/**
 * Generate a unique reservation number.
 * Format: RES-XXXXXX (6 alphanumeric uppercase characters).
 *
 * @return string The generated reservation number.
 */
function lef_generate_reservation_number() {
	global $wpdb;
	$prefix = 'RES-';
	$table  = $wpdb->prefix . 'ls_reservation';

	do {
		$random_part = strtoupper( wp_generate_password( 6, false, false ) );
		$res_number  = $prefix . $random_part;

		// Check if this number already exists in the database
		$exists = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM $table WHERE reservation_number = %s",
			$res_number
		) );
	} while ( $exists > 0 );

	return $res_number;
}



/**
 * Check if email or mobile number is already in use by another user.
 *
 * @param string $type            'email' or 'mobile_number'.
 * @param string $value           The value to check.
 * @param int    $current_user_id To exclude current user.
 * @return bool True if duplicate exists, false otherwise.
 */
function lef_is_contact_duplicate( $type, $value, $current_user_id ) {
    global $wpdb;

    if ( $type === 'email' ) {
        $exists = $wpdb->get_var( $wpdb->prepare(
            "SELECT ID FROM $wpdb->users WHERE user_email = %s AND ID != %d",
            $value,
            $current_user_id
        ) );
        return (bool) $exists;
    }

    if ( $type === 'mobile_number' ) {
        $exists = $wpdb->get_var( $wpdb->prepare(
            "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'mobile_number' AND meta_value = %s AND user_id != %d",
            $value,
            $current_user_id
        ) );
        return (bool) $exists;
    }

    	return false;
}

/**
 * Truncate property title based on the centralized character limit to prevent layout breaking.
 *
 * @param string $title The property title.
 * @return string Truncated title with '..' suffix if it exceeds the limit.
 */
function lef_format_property_title( $title ) {
	// CONFIGURABLE: Centralized character limit for property titles across all templates.
	// You can change this number (e.g., 35) to increase or decrease the globally allowed title length.
	$limit = 35;

	$title = stripslashes( (string) $title );
	if ( mb_strlen( $title ) > $limit ) {
		return mb_substr( $title, 0, $limit ) . '..';
	}
	return $title;
}
