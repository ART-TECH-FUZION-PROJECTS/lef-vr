<?php
/**
 * Template: Generic Loading Screen Overlay
 *
 * Renders a customizable fullscreen loading screen overlay.
 * Customize by defining variables before including:
 * - $lef_loader_logo (string): Logo emoji/text (default: '🏡')
 * - $lef_loader_title (string): Main heading text (default: 'Loading...')
 * - $lef_loader_subtitle (string): Subtitle description text (default: 'Please wait...')
 *
 * @package ListingEngineFrontend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$loader_logo     = isset( $lef_loader_logo ) ? $lef_loader_logo : '🏡';
$loader_title    = isset( $lef_loader_title ) ? $lef_loader_title : __( 'Loading...', 'listing-engine-frontend' );
$loader_subtitle = isset( $lef_loader_subtitle ) ? $lef_loader_subtitle : __( 'Please wait while we prepare the content', 'listing-engine-frontend' );
?>
<div id="lef-spv-loader-overlay" class="lef-spv-loader-overlay">
	<div class="lef-spv-loader-content">
		<div class="lef-spv-loader-logo"><?php echo esc_html( $loader_logo ); ?></div>
		<h3 class="lef-spv-loader-title"><?php echo esc_html( $loader_title ); ?></h3>
		<p class="lef-spv-loader-subtitle"><?php echo esc_html( $loader_subtitle ); ?></p>
		<div class="lef-spv-progress-container">
			<div class="lef-spv-progress-bar"></div>
		</div>
	</div>
</div>
