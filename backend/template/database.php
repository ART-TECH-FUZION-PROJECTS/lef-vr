<?php
/**
 * Database Management Admin Template.
 * Dynamically lists table statuses and enables creation/repair under custom prefixes.
 *
 * @package ListingEngineFrontend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wpdb;
$reservation_table = $wpdb->prefix . 'ls_reservation';
$reviews_table     = $wpdb->prefix . 'ls_reviews';
$wishlist_table    = $wpdb->prefix . 'ls_wishlist';
?>
<div class="wrap">
    <!-- This hidden h2 and the empty notice container catch WordPress admin notices before they get moved into our custom header. -->
    <h2 class="lef-admin-notice-placeholder"></h2>

    <div class="lef-db lef-global-plugin-wrapper">
        <div class="lef-db-header">
            <div class="svg-cont">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                </svg>
            </div>
            <h1 class="heading">Database Management</h1>
        </div>

        <div class="lef-db-grid">
            <!-- Reservation Table Card -->
            <div class="lef-db-card" data-table="<?php echo esc_attr( $reservation_table ); ?>">
                <h2 class="card-title">Reservation Table</h2>

                <div class="statuses">
                    <div class="status-row">
                        <span class="status-label">Table Created:</span>
                        <span class="badge badge--pending" id="status-created">Checking...</span>
                    </div>
                    <div class="status-row">
                        <span class="status-label">Rows Complete:</span>
                        <span class="badge badge--pending" id="status-rows">Checking...</span>
                    </div>
                </div>

                <div class="actions">
                    <!-- Refresh button -->
                    <button class="btn btn-refresh" onclick="lef_db_refresh('<?php echo esc_js( $reservation_table ); ?>')">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                        </svg>
                        <span class="btn-label">Refresh</span>
                    </button>

                    <!-- Create/Repair button -->
                    <button class="btn btn-repair" onclick="lef_db_repair('<?php echo esc_js( $reservation_table ); ?>')">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="btn-label">Create / Repair</span>
                    </button>
                </div>
            </div>

            <!-- Reviews Table Card -->
            <div class="lef-db-card" data-table="<?php echo esc_attr( $reviews_table ); ?>">
                <h2 class="card-title">Reviews Table</h2>

                <div class="statuses">
                    <div class="status-row">
                        <span class="status-label">Table Created:</span>
                        <span class="badge badge--pending" id="status-created">Checking...</span>
                    </div>
                    <div class="status-row">
                        <span class="status-label">Rows Complete:</span>
                        <span class="badge badge--pending" id="status-rows">Checking...</span>
                    </div>
                </div>

                <div class="actions">
                    <!-- Refresh button -->
                    <button class="btn btn-refresh" onclick="lef_db_refresh('<?php echo esc_js( $reviews_table ); ?>')">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                        </svg>
                        <span class="btn-label">Refresh</span>
                    </button>

                    <!-- Create/Repair button -->
                    <button class="btn btn-repair" onclick="lef_db_repair('<?php echo esc_js( $reviews_table ); ?>')">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="btn-label">Create / Repair</span>
                    </button>
                </div>
            </div>

            <!-- Wishlist Table Card -->
            <div class="lef-db-card" data-table="<?php echo esc_attr( $wishlist_table ); ?>">
                <h2 class="card-title">Wishlist Table</h2>

                <div class="statuses">
                    <div class="status-row">
                        <span class="status-label">Table Created:</span>
                        <span class="badge badge--pending" id="status-created">Checking...</span>
                    </div>
                    <div class="status-row">
                        <span class="status-label">Rows Complete:</span>
                        <span class="badge badge--pending" id="status-rows">Checking...</span>
                    </div>
                </div>

                <div class="actions">
                    <!-- Refresh button -->
                    <button class="btn btn-refresh" onclick="lef_db_refresh('<?php echo esc_js( $wishlist_table ); ?>')">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                        </svg>
                        <span class="btn-label">Refresh</span>
                    </button>

                    <!-- Create/Repair button -->
                    <button class="btn btn-repair" onclick="lef_db_repair('<?php echo esc_js( $wishlist_table ); ?>')">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="btn-label">Create / Repair</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>