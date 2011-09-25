<?php
/*
Plugin Name: WeeverApps
Plugin URI: http://weeverapps.com/downloads
Description: Weever Apps Administrator Component for Wordpress
Version: 0.1
Author: Brian Hogg
Author URI: http://brianhogg.com/
License: GPL3
*/

/*  Copyright 2011 Weever Apps Inc. (email : brian@weeverapps.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'WEEVER_VERSION', '0.1' );
define( 'WEEVER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WEEVER_ADMIN_TEMPLATE_DIR', plugins_url( 'templates/admin/', __FILE__ ) );

// Weever debug flag
if ( ! defined( 'WEEVER_DEV' ) )
    define( 'WEEVER_DEV', false );

if ( ! function_exists( 'add_action' ) ) {
	echo "Plugin file cannot be called directly.";
	exit;
}

// TODO: Check for earliest WP version tested and functional

// Weever constants
require_once dirname( __FILE__ ) . '/classes/class-weever-const.php';

// R3S classes for app content output
require_once dirname( __FILE__ ) . '/classes/class-r3s.php';

// SimpleDOM HTML parser
require_once dirname( __FILE__ ) . '/classes/class-simpledom.php';

// Weever plugin helper functions
require_once dirname( __FILE__ ) . '/classes/class-weever-helper.php';

// Weever App state object classes
require_once dirname( __FILE__ ) . '/classes/class-weever-app.php';
require_once dirname( __FILE__ ) . '/classes/class-weever-app-tab.php';
require_once dirname( __FILE__ ) . '/classes/class-weever-app-subtab.php';
require_once dirname( __FILE__ ) . '/classes/class-weever-app-theme-styles.php';

if ( is_admin() )
{
	require_once dirname( __FILE__ ) . '/admin.php';
	require_once dirname( __FILE__ ) . '/classes/class-weever-controller.php';

}

// Register the ajax call
add_action( 'wp_ajax_ajaxSubtabDelete', array( 'WeeverController', 'ajaxSubtabDelete' ) );
add_action( 'wp_ajax_ajaxSaveTabName', array( 'WeeverController', 'ajaxSaveTabName' ) );
add_action( 'wp_ajax_ajaxSaveTabIcon', array( 'WeeverController', 'ajaxSaveTabIcon' ) );

function weever_init() {

    // Initialize the session
    if ( ! session_id() )
	    session_start();

	// Load i18n
    load_plugin_textdomain( 'weever', false, 'weever/languages' );

	// Check if a feed or the admin site is being accessed
	if ( is_feed() || is_admin() )
	    return;

	// Verify the app is enabled
	if ( get_option( 'weever_api_key' ) && get_option( 'weever_app_enabled' ) )
	{
	    // Run the mobile checks
	    // TODO: Add the MobileESP code here
	    die('here');
	}
}

add_action( 'init', 'weever_init', 0 );

/*
 * Custom R3S feed for content distribution
 */

function weever_create_r3sfeed() {
    load_template( dirname( __FILE__ ) . '/templates/feed-r3s.php' );
}

add_action( 'do_feed_r3s', 'weever_create_r3sfeed', 10, 1 );

function weever_no_limits_for_feed( $limits ) {
    global $wp_query;

    if ( isset( $wp_query->query_vars['feed'] ) and ( $wp_query->query_vars['feed'] == 'r3s' ) )
	    return '';
}

add_filter( 'post_limits', 'weever_no_limits_for_feed' );

/**
 * Disable the feed cache if we're in development mode
 */
function weever_disable_feed_cache(&$feed) {
	$feed->enable_cache(false);
}
if ( WEEVER_DEV ) {
	add_action( 'wp_feed_options', 'weever_disable_feed_cache' );
}

/**
 * Handling the sending of individual pieces of content to the Weever app
 */
function weever_app_request() {
    global $wp_query;

    if ( array_key_exists( 'template', $wp_query->query_vars ) && $wp_query->query_vars['template'] == 'weever_cartographer' )
    {
        include( dirname( __FILE__ ) . '/templates/content-single.php' );
        exit;
    }
}

add_action('template_redirect', 'weever_app_request');

/**
 * Additional query variables needed by Weever Apps
 */
function weever_query_vars($vars) {
    $vars[] = 'template';

    // For including a callback function for R3S feed/document
    $vars[] = 'callback';
    return $vars;
}

add_filter('query_vars', 'weever_query_vars');