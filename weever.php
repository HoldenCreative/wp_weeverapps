<?php
/*
Plugin Name: Weever Apps
Plugin URI: http://weeverapps.com/
Description: Weever Apps Administrator Component for Wordpress
Version: 1.3
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

// Mobile detection class
require_once dirname( __FILE__ ) . '/classes/class-weever-mdetect.php';

// Weever plugin helper functions
require_once dirname( __FILE__ ) . '/classes/class-weever-helper.php';

// Weever App state object classes
require_once dirname( __FILE__ ) . '/classes/class-weever-app.php';
require_once dirname( __FILE__ ) . '/classes/class-weever-app-tab.php';
require_once dirname( __FILE__ ) . '/classes/class-weever-app-subtab.php';
require_once dirname( __FILE__ ) . '/classes/class-weever-app-theme-styles.php';

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/admin.php';
	require_once dirname( __FILE__ ) . '/classes/class-weever-controller.php';

    // Register the ajax calls
    add_action( 'wp_ajax_ajaxSubtabDelete', array( 'WeeverController', 'ajaxSubtabDelete' ) );
    add_action( 'wp_ajax_ajaxSaveTabName', array( 'WeeverController', 'ajaxSaveTabName' ) );
    add_action( 'wp_ajax_ajaxSaveTabIcon', array( 'WeeverController', 'ajaxSaveTabIcon' ) );
    add_action( 'wp_ajax_ajaxTabPublish', array( 'WeeverController', 'ajaxTabPublish' ) );
    add_action( 'wp_ajax_ajaxPublishSelected', array( 'WeeverController', 'ajaxPublishSelected' ) );
    add_action( 'wp_ajax_ajaxUnpublishSelected', array( 'WeeverController', 'ajaxUnpublishSelected' ) );
    add_action( 'wp_ajax_ajaxDeleteSelected', array( 'WeeverController', 'ajaxDeleteSelected' ) );
    add_action( 'wp_ajax_ajaxSaveSubtabOrder', array( 'WeeverController', 'ajaxSaveSubtabOrder' ) );
    add_action( 'wp_ajax_ajaxSaveTabOrder', array( 'WeeverController', 'ajaxSaveTabOrder' ) );
    add_action( 'wp_ajax_ajaxSaveNewTab', array( 'WeeverController', 'ajaxSaveNewTab' ) );
    add_action( 'wp_ajax_ajaxToggleAppStatus', array( 'WeeverController', 'ajaxToggleAppStatus' ) );
    add_action( 'wp_ajax_ajaxUpdateTabSettings', array( 'WeeverController', 'ajaxUpdateTabSettings' ) );
}

function weever_activate() {
	// Call the upgrade function to make sure this key is up to date
	$weeverapp = new WeeverApp( false );

	if ( $weeverapp->site_key )
		$weeverapp->upgrade_site_key();
}

register_activation_hook( __FILE__, 'weever_activate' );

function weever_init() {
    // Initialize the session
    if ( ! session_id() && !is_admin() )
	    session_start();

	// Load i18n
    load_plugin_textdomain( 'weever', false, basename(dirname(__FILE__)) . '/languages/' );

	// Check if a feed, R3S encoded template, or the admin site is being accessed
	$template = get_query_var( 'template' );
	$callback = get_query_var( 'callback' );

	if ( is_feed() || is_admin() || ! empty( $template ) || ! empty( $callback ) ) {
	    return;
	}

	// Verify the app is enabled
	$weeverapp = new WeeverApp( false );
	if ( $weeverapp->site_key && $weeverapp->app_enabled && $weeverapp->primary_domain )
	{
	    // Run the mobile checks
		$uagent_obj = new WeeverMdetect();

		if ( ! $uagent_obj->DetectWebkit() ) {
			$_SESSION['ignore_mobile'] = '1';
			return;
		}

		$weever_app_redirect = false;

		if ( $weeverapp->granular ) {
		    $devices = $weeverapp->get_granular_device_option_names();
		} else {
		    $devices = $weeverapp->get_standard_device_option_names();
		}

		foreach ( $devices as $device ) {
			if ( $weeverapp->$device ) {
				if ( $uagent_obj->$device() ) {
					$weever_app_redirect = true;
					break;
				}
			}
		}

		if ( $weever_app_redirect === false ) {
			$_SESSION['ignore_mobile'] = '1';
			return;
		}

		$request_uri = $_SERVER['REQUEST_URI'];

		$request_uri = str_replace( "?full=0", "", $request_uri );
		$request_uri = str_replace( "&full=0", "", $request_uri );

		if ( $request_uri && $request_uri != 'index.php' && $request_uri != '/' )
			$exturl = '?exturl=' . $request_uri;
		else
			$exturl = "";

        // Redirect either to the app page or their own domain
        // TODO: Check the tier is 1 also?
		if ( $weeverapp->domain ) {
			$url = 'http://' . $weeverapp->domain . $exturl;
		} else {
			$url = 'http://weeverapp.com/app/' . $weeverapp->primary_domain . $exturl;
		}

		header( 'Location: ' . $url );

		die();
	}
}

add_action( 'posts_selection', 'weever_init', 0 );

/**
 * Add a link to the settings page from the plugins listing page
 *
 * @param array $links
 */
function weever_settings_link( $links ) {
    if ( function_exists( "admin_url" ) ) {
		$settings_link = '<a href="' . admin_url( 'admin.php?page=weever-account' ) . '">' . __( 'Settings' ) . '</a>';
        array_push( $links, $settings_link );
    }
    return $links;
}

add_filter( 'plugin_action_links_weever/weever.php', 'weever_settings_link' );

/*
 * Custom R3S feed for content distribution
 */

function weever_create_r3sfeed() {
    load_template( dirname( __FILE__ ) . '/templates/feed-r3s.php' );
}

add_action( 'do_feed_r3s', 'weever_create_r3sfeed', 10, 1 );

function weever_no_limits_for_feed( $limit ) {
    global $wp_query;

    if ( isset( $wp_query->query_vars['feed'] ) and ( $wp_query->query_vars['feed'] == 'r3s' ) )
	    return '';
	else
		return $limit;
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

    if ( array_key_exists( 'template', $wp_query->query_vars ) )
    {
    	switch ( $wp_query->query_vars['template'] ) {
    		case 'weever_cartographer':
		    	// Capture the HTML from the template file
				ob_start();

				the_post();

				header('Content-type: application/json');
				header('Cache-Control: no-cache, must-revalidate');

				$callback = get_query_var('callback');

				// specs @ https://github.com/WeeverApps/r3s-spec

				$jsonHtml = new R3SHtmlContentDetailsMap;

				$jsonHtml->language = get_locale();

				// TODO: Get the sitename from the current site state
				$jsonHtml->publisher = get_option('blogname'); // $conf->getValue('config.sitename');

				$jsonHtml->name = get_the_title();
				$jsonHtml->author = get_the_author_meta('display_name');
				$jsonHtml->datetime["published"] = get_lastpostdate('GMT'); //mysql2date('Y-m-d H:i:s', get_lastpostdate('GMT'), false);  //$v->created;
				$jsonHtml->datetime["modified"] = get_lastpostmodified('GMT'); //mysql2date('Y-m-d H:i:s', get_lastpostmodified('GMT'), false); //$v->modified;

				if ( file_exists( get_stylesheet_directory() . '/weever-content-single.php' ) )
					include( get_stylesheet_directory() . '/weever-content-single.php' );
				elseif ( file_exists( get_template_directory() . '/weever-content-single.php' ) )
					include( get_template_directory() . '/weever-content-single.php' );
				else
		        	include( dirname( __FILE__ ) . '/templates/weever-content-single.php' );

				$jsonHtml->html =  ob_get_clean();
				$jsonHtml->image = null;

				$html = SimpleHTMLDomHelper::str_get_html( $jsonHtml->html );

				foreach ( @$html->find('img') as $vv )
				{
					if ( $vv->src )
					{
						$jsonHtml->image = WeeverHelper::make_absolute($vv->src, site_url());
						break;
					}
				}

				if ( ! $jsonHtml->image )
					$jsonHtml->image = "";

				// Mask external links so we leave only internal ones to play with.
				$jsonHtml->html = str_replace("href=\"http://", "hrefmask=\"weever://", $jsonHtml->html);

				// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
				$jsonHtml->html = str_replace("target=\"_blank\"", "", $jsonHtml->html);
				$jsonHtml->html = str_replace("href=\"", "target=\"_blank\" href=\"".site_url(), $jsonHtml->html);
				$jsonHtml->html = str_replace("src=\"/", "src=\"".site_url(), $jsonHtml->html);
				$jsonHtml->html = str_replace("src=\"images", "src=\"".site_url()."images", $jsonHtml->html);

				// Restore external links, ensure target="_blank" applies
				$jsonHtml->html = str_replace("hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);
				$jsonHtml->html = str_replace("<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
													"<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html);

				$jsonOutput = new jsonOutput;
				$jsonOutput->results[] = $jsonHtml;
				$output = json_encode($jsonOutput);

				if($callback)
					$json = $callback."(".$output.")";
				else
					$json = $output;

				print_r($json);

		        exit;

    		case 'weever_css':

				header('Content-type: text/css');
				header('Cache-Control: no-cache, must-revalidate');

				if ( file_exists( get_stylesheet_directory() . '/weever.css' ) )
					include( get_stylesheet_directory() . '/weever.css' );
				elseif ( file_exists( get_template_directory() . '/weever.css' ) )
					include( get_template_directory() . '/weever.css' );

				exit;
    	}
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