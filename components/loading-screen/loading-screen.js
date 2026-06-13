/**
 * loading-screen.js
 *
 * Generic loading screen overlay controller.
 * Exposes a global `LEF_Loader` object to show and hide the loader overlay
 * from any script in the plugin.
 *
 * @package ListingEngineFrontend
 */

(function () {
	'use strict';

	var LEF_Loader = {
		overlayElement: null,

		/**
		 * Cache the overlay element.
		 */
		init: function () {
			if ( ! this.overlayElement ) {
				this.overlayElement = document.getElementById( 'lef-spv-loader-overlay' );
			}
		},

		/**
		 * Instantly show the loading overlay, optionally updating the text.
		 *
		 * @param {string} [title] Optional main heading text.
		 * @param {string} [subtitle] Optional subtitle description text.
		 */
		show: function ( title, subtitle ) {
			this.init();
			if ( this.overlayElement ) {
				if ( title ) {
					var titleEl = this.overlayElement.querySelector( '.lef-spv-loader-title' );
					if ( titleEl ) {
						titleEl.textContent = title;
					}
				}
				if ( subtitle ) {
					var subtitleEl = this.overlayElement.querySelector( '.lef-spv-loader-subtitle' );
					if ( subtitleEl ) {
						subtitleEl.textContent = subtitle;
					}
				}
				this.overlayElement.classList.remove( 'hide' );
			}
		},

		/**
		 * Hide the loading overlay, optionally after a delay.
		 *
		 * @param {number} delay Delay in milliseconds before hiding.
		 */
		hide: function ( delay ) {
			this.init();
			if ( ! this.overlayElement ) {
				return;
			}
			var self = this;
			if ( typeof delay === 'number' && delay > 0 ) {
				setTimeout( function () {
					self.overlayElement.classList.add( 'hide' );
				}, delay );
			} else {
				this.overlayElement.classList.add( 'hide' );
			}
		}
	};

	// Expose to global window scope.
	window.LEF_Loader = LEF_Loader;

})();
