<?php
/**
 * View/Edit Review Standalone Template.
 * Prefix: lef-manag-revi-
 *
 * @package ListingEngineFrontend
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! isset($review)) {
    echo '<div class="wrap"><div class="error"><p>Review data not found.</p></div></div>';
    return;
}

$status_label = ($review['status'] === 'approve' || $review['status'] === 'approved') ? 'Approved' : ucfirst($review['status']);
$property_url = lef_get_secure_detail_url($review['property_id']);
?>

<div class="wrap">
    <!-- Notice Placeholder -->
    <h2 class="lef-admin-notice-placeholder" style="display:none;"></h2>
    <div id="lef-manag-revi-edit-page-wrapper" class="lef-global-plugin-wrapper">
        <main class="lef-manag-revi-edit-page">
            <header class="lef-manag-revi-edit-topbar">
                <a class="lef-manag-revi-edit-back-btn" href="admin.php?page=lef-manage-reviews" aria-label="Back to reviews">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:16px;height:16px;">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    Back
                </a>
                <h1 class="lef-manag-revi-edit-page-title">Review Details</h1>
                <span class="lef-manag-revi-edit-status-badge" id="lef-manag-revi-edit-current-status"
                    data-lef-manag-revi-edit-status="<?php echo esc_attr($review['status'] === 'approve' ? 'approved' : $review['status']); ?>">
                    <?php echo esc_html($status_label); ?>
                </span>
            </header>

            <section class="lef-manag-revi-edit-summary" aria-label="Review summary">
                <div class="lef-manag-revi-edit-field">
                    <span class="lef-manag-revi-edit-label">Property Name</span>
                    <span class="lef-manag-revi-edit-value lef-manag-revi-edit-property-name">
                        <?php echo esc_html($review['property_title']); ?>
                    </span>
                </div>
                <div class="lef-manag-revi-edit-field">
                    <span class="lef-manag-revi-edit-label">Submitted On</span>
                    <span class="lef-manag-revi-edit-value">
                        <?php echo esc_html(date('F j, Y g:i A', strtotime($review['created_at']))); ?>
                    </span>
                </div>
                <div class="lef-manag-revi-edit-summary-action">
                    <a href="<?php echo esc_url($property_url); ?>" class="lef-manag-revi-edit-view-btn" target="_blank">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:16px;height:16px;">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        View Property
                    </a>
                </div>
            </section>

            <div class="lef-manag-revi-edit-content-grid">
                <!-- Review Content -->
                <section class="lef-manag-revi-edit-section" aria-labelledby="lef-manag-revi-edit-review-title">
                    <div class="lef-manag-revi-edit-section-head">
                        <span class="lef-manag-revi-edit-section-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" style="width:20px;height:20px;">
                                <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>
                            </svg>
                        </span>
                        <h2 class="lef-manag-revi-edit-section-title" id="lef-manag-revi-edit-review-title">Review & Rating</h2>
                    </div>
                    <div class="lef-manag-revi-edit-detail-list">
                        <div class="lef-manag-revi-edit-detail-row">
                            <span class="lef-manag-revi-edit-detail-label">Rating</span>
                            <span class="lef-manag-revi-edit-detail-value" style="display: flex; align-items: center; gap: 4px;">
                                <?php echo esc_html($review['rating']); ?> / 5.0
                                <span style="color: #ffb100;">★</span>
                            </span>
                        </div>
                        <div class="lef-manag-revi-edit-detail-row" style="flex-direction: column; align-items: flex-start; gap: 8px;">
                            <span class="lef-manag-revi-edit-detail-label">Review text</span>
                            <div class="lef-manag-revi-edit-text-box" style="background: var(--lef-bg-light); border: 1px solid var(--lef-border-color); border-radius: 8px; padding: 12px; width: 100%; box-sizing: border-box; line-height: 1.6; color: var(--lef-text-color);">
                                <?php echo nl2br(esc_html($review['review'])); ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Traveller Details -->
                <section class="lef-manag-revi-edit-section" aria-labelledby="lef-manag-revi-edit-user-title">
                    <div class="lef-manag-revi-edit-section-head">
                        <span class="lef-manag-revi-edit-section-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" style="width:20px;height:20px;">
                                <path d="M20 21a8 8 0 0 0-16 0"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <h2 class="lef-manag-revi-edit-section-title" id="lef-manag-revi-edit-user-title">Traveller Details</h2>
                    </div>
                    <div class="lef-manag-revi-edit-detail-list">
                        <div class="lef-manag-revi-edit-detail-row">
                            <span class="lef-manag-revi-edit-detail-label">Name</span>
                            <span class="lef-manag-revi-edit-detail-value"><?php echo esc_html($review['user']['name']); ?></span>
                        </div>
                        <div class="lef-manag-revi-edit-detail-row">
                            <span class="lef-manag-revi-edit-detail-label">Email</span>
                            <span class="lef-manag-revi-edit-detail-value"><?php echo esc_html($review['user']['email']); ?></span>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Status Update Card -->
            <section class="lef-manag-revi-edit-status-card" aria-label="Change review status">
                <div>
                    <div class="lef-manag-revi-edit-status-control">
                        <select class="lef-manag-revi-edit-status-select" id="lef-manag-revi-edit-status-select">
                            <option value="pending" <?php selected($review['status'], 'pending'); ?>>Pending</option>
                            <option value="approved" <?php selected(in_array($review['status'], array('approve', 'approved')), true); ?>>Approved</option>
                            <option value="rejected" <?php selected($review['status'], 'rejected'); ?>>Rejected</option>
                        </select>
                        <span class="lef-manag-revi-edit-select-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </span>
                    </div>
                    <p class="lef-manag-revi-edit-save-note" id="lef-manag-revi-edit-save-note">Status updated successfully!</p>
                </div>
                <button class="lef-manag-revi-edit-save-btn" id="lef-manag-revi-edit-save-btn" type="button" data-id="<?php echo intval($review['id']); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:16px;height:16px;">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <path d="M17 21v-8H7v8"></path>
                        <path d="M7 3v5h8"></path>
                    </svg>
                    Save
                </button>
            </section>
        </main>
    </div>
</div>
