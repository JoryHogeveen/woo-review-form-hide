<?php
/**
 * Plugin Name:       WooCommerce Reviews - Hide Form
 * Description:       Hides the Woocommerce review form until user selects a rating
 * Version:           1.1
 * Author:            Jory Hogeveen
 * Author URI:        https://www.keraweb.nl
 * Text Domain:       woo-review-form-hide
 * GitHub Plugin URI: JoryHogeveen/woo-review-form-hide
 */

if ( ! defined ( 'ABSPATH' ) ) {
	die;
}

Woo_Review_Hide_Form::get_instance();

class Woo_Review_Hide_Form
{
	/**
	 * @var Woo_Review_Hide_Form
	 */
	private static $_instance = null;

	/**
	 * @return Woo_Review_Hide_Form
	 */
	public static function get_instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Woo_Review_Hide_Form constructor.
	 */
	protected function __construct() {
		add_action( 'wp_footer', __CLASS__ . '::script' );
	}

	/**
	 * Render inline script.
	 */
	public static function script() {
		if ( ! did_action( 'comment_form' ) ) {
			return;
		}
		if ( ! function_exists( 'wc_review_ratings_enabled' ) || ! wc_review_ratings_enabled() ) {
			return;
		}

		echo '<script id="woo-review-hide-form">';
		include 'js/inline-script.js';
		echo '</script>';
	}
}
