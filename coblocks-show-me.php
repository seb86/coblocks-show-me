<?php
/*
 * Plugin Name: CoBlocks Show Me
 * Plugin URI:  https://github.com/seb86/coblocks-show-me
 * Description: Shows were the action hooks are available though out the CoBlocks theme.
 * Author: Sébastien Dumont
 * Author URI: https://sebastiendumont.com
 * Version: 1.0.0
 * Text Domain: coblocks-show-me
 * Domain Path: /languages/
 *
 * Copyright: © 2018 Sébastien Dumont
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package   CoBlocks Show Me
 * @author    Sébastien Dumont
 * @copyright Copyright © 2018, Sébastien Dumont
 * @license   GNU General Public License v3.0 http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! class_exists( 'CoBlocks_Show_Me' ) ) {
	class CoBlocks_Show_Me {

		/**
		 * @var CoBlocks_Show_Me - the single instance of the class.
		 *
		 * @access protected
		 * @static
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Plugin Version
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 */
		public static $version = '1.0.0';

		/**
		 * Main CoBlocks_Show_Me Instance.
		 *
		 * Ensures only one instance of CoBlocks_Show_Me is loaded or can be loaded.
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @see    CoBlocks_Show_Me()
		 * @return CoBlocks_Show_Me - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		} // END instance()

		/**
		 * Cloning is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cloning this object is forbidden.', 'coblocks-show-me' ), self::$version );
		} // END __clone()

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'coblocks-show-me' ), self::$version );
		} // END __wakeup()

		/**
		 * CoBlocks_Show_Me Constructor.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return CoBlocks_Show_Me
		 */
		public function __construct() {
			$this->init_hooks();
		} // END __construct()

		/**
		 * Initialize hooks.
		 *
		 * @access private
		 * @since  1.0.0
		 */
		private function init_hooks() {
			// Load textdomain.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ), 0 );

			// Show action hook locations.
			add_action( 'init', array( $this, 'show_action_hooks' ) );
		} // END init_hooks()

		/**
		 * Shows an indicator as to where the action hooks are available.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function show_action_hooks() {
			$action_hooks = array(
				'before_site_logo',
				'after_site_logo',
				'before_header',
				'after_header',
				'before_nav',
				'after_nav',
				'before_footer',
				'after_footer',
				'before_comments',
				'after_comments',
				'before_footer_widgets',
				'after_footer_widgets',
				'before_content',
				'after_content',
				'before_entry_title',
				'after_entry_title',
			);

			foreach ( $action_hooks as $hook ) {
				add_action( 'coblocks_' . $hook, array( $this, 'coblocks_' . $hook ) );
			}
		} // END show_action_hooks()

		/**
		 * Shows the hook.
		 *
		 * @access public
		 */
		public function show_hook( $hook, $message, $color = '#d73a4a', $border = '2px' ) {
			return apply_filters( 'coblocks_show_hook', '<div style="width:100%; position:relative; border-bottom: ' . $border . ' solid ' . $color . '; font-size: 10pt; font-family: monospace">' . $message . '</div>', $hook, $message, $color );
		}

		/**
		 * Action hooks.
		 *
		 * @access public
		 */
		public function coblocks_before_site_logo() {
			echo self::show_hook( 'coblocks_before_site_logo', '<div><p style="background-color: #d73a4a; color: white; display: initial; padding: 4px;">coblocks_before_site_logo</p></div>', '0' );
		}

		public function coblocks_after_site_logo() {
			echo self::show_hook( 'coblocks_after_site_logo', '<div><p style="background-color: #d73a4a; color: white; display: initial; padding: 4px;">coblocks_after_site_logo</p></div>', '0' );
		}

		public function coblocks_before_header() {
			echo self::show_hook( 'coblocks_before_header', '<div><p style="background-color: #cfd3d7; color: black; display: initial; padding: 4px;">coblocks_before_header</p></div>', '#cfd3d7' );
		}

		public function coblocks_after_header() {
			echo self::show_hook( 'coblocks_after_header', '<div><p style="background-color: #cfd3d7; color: black; display: initial; padding: 4px;">coblocks_after_header</p></div>', '#cfd3d7' );
		}

		public function coblocks_before_nav() {
			echo self::show_hook( 'coblocks_before_nav', '<div><p style="background-color: #a2eeef; color: black; display: initial; padding: 4px;">coblocks_before_nav</p></div>', '#a2eeef' );
		}

		public function coblocks_after_nav() {
			echo self::show_hook( 'coblocks_after_nav', '<div><p style="background-color: #a2eeef; color: black; display: initial; padding: 4px;">coblocks_after_nav</p></div>', '#a2eeef' );
		}

		public function coblocks_before_footer() {
			echo self::show_hook( 'coblocks_before_footer', '<div><p style="background-color: #7057ff; color: white; display: initial; padding: 4px;">coblocks_before_footer</p></div>', '#7057ff' );
		}

		public function coblocks_after_footer() {
			echo self::show_hook( 'coblocks_after_footer', '<div><p style="background-color: #7057ff; color: white; display: initial; padding: 4px;">coblocks_after_footer</p></div>', '#7057ff' );
		}

		public function coblocks_before_comments() {
			echo self::show_hook( 'coblocks_before_comments', '<div><p style="background-color: #008672; color: white; display: initial; padding: 4px;">coblocks_before_comments</p></div>', '#008672' );
		}

		public function coblocks_after_comments() {
			echo self::show_hook( 'coblocks_after_comments', '<div><p style="background-color: #008672; color: white; display: initial; padding: 4px;">coblocks_after_comments</p></div>', '#008672' );
		}

		public function coblocks_before_footer_widgets() {
			echo self::show_hook( 'coblocks_before_footer_widgets', '<div><p style="background-color: #e4e669; color: black; display: initial; padding: 4px;">coblocks_before_footer_widgets</p></div>', '#e4e669' );
		}

		public function coblocks_after_footer_widgets() {
			echo self::show_hook( 'coblocks_after_footer_widgets', '<div><p style="background-color: #e4e669; color: black; display: initial; padding: 4px;">coblocks_after_footer_widgets</p></div>', '#e4e669' );
		}

		public function coblocks_before_content() {
			echo self::show_hook( 'coblocks_before_content', '<div><p style="background-color: #d876e3; color: black; display: initial; padding: 4px;">coblocks_before_content</p></div>', '#d876e3' );
		}

		public function coblocks_after_content() {
			echo self::show_hook( 'coblocks_after_content', '<div><p style="background-color: #d876e3; color: black; display: initial; padding: 4px;">coblocks_after_content</p></div>', '#d876e3' );
		}

		public function coblocks_before_entry_title() {
			echo self::show_hook( 'coblocks_before_entry_title', '<div><p style="background-color: #00a5b7; color: black; display: initial; padding: 4px;">coblocks_before_entry_title</p></div>', '#00a5b7' );
		}

		public function coblocks_after_entry_title() {
			echo self::show_hook( 'coblocks_after_entry_title', '<div><p style="background-color: #00a5b7; color: black; display: initial; padding: 4px;">coblocks_after_entry_title</p></div>', '#00a5b7' );
		}

		/**
		 * Make the plugin translation ready.
		 *
		 * Translations should be added in the WordPress language directory:
		 *  - WP_LANG_DIR/plugins/coblocks-show-me-LOCALE.mo
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'coblocks-show-me', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		} // END load_plugin_textdomain()

	} // END class

} // END if class exists

return CoBlocks_Show_Me::instance();
