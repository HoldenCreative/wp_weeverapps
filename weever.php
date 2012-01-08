<?php
/*
Plugin Name: Weever Apps - Mobile Web Apps
Plugin URI: http://weeverapps.com/
Description: Weever Apps: Turn your site into a true HTML5 'web app' for iPhone, Android and Blackberry 
Version: 1.4.2
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
require_once dirname( __FILE__ ) . '/classes/class-weever-app-theme-launch.php';

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

function weever_update() {
	$db_version = get_option( 'weever_db_version', '' );
	
	if ( WeeverConst::VERSION != $db_version ) {
		// Call the upgrade function to make sure this key is up to date
		$weeverapp = new WeeverApp( false );
	
		if ( $weeverapp->site_key )
			$weeverapp->upgrade_site_key();
		
		update_option( 'weever_db_version', WeeverConst::VERSION );
	}
}

add_action('init', 'weever_update', 1);

/**
 * Function to load and show bar along the bottom if we're viewing in a mobile browser
 */
/*
function weever_desktop_init() {
	wp_register_script( 'weever-desktop', plugins_url( 'static/js/weever-desktop.js' ), array( 'jquery' ), WeeverConst::VERSION, true );		
}

add_action('init', 'weever_desktop_init');
*/
function weever_get_redirect_url( $weeverapp = false ) {
	if ( $weeverapp === false )
		$weeverapp = new WeeverApp( false );
	
	// Pass through the app url
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
	
	return $url;
}

// http://www.webcheatsheet.com/PHP/get_current_page_url.php
function weever_get_current_url() {
	$page_url = 'http';
	if ( isset( $_SERVER['HTTPS'] ) and 'on' == $_SERVER['HTTPS'] )
		$page_url .= "s";
	$page_url .= "://";
	if ( isset( $_SERVER['SERVER_PORT'] ) and '80' != $_SERVER['SERVER_PORT'] ) {
		$page_url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
	} else {
		$page_url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}
	return $page_url;
}

function weever_desktop_print_scripts() {
	$weeverapp = new WeeverApp( false );
	
	wp_register_script( 'weever-desktop', WEEVER_PLUGIN_URL . 'static/js/weever-desktop.js', array( 'jquery' ), WeeverConst::VERSION, true );
	wp_enqueue_script('weever-desktop');
	
	$url = weever_get_current_url();
	
	// Replace full param
	$params = array();
	$query = parse_url( $url, PHP_URL_QUERY );
	parse_str( $query, $params );
	if ( isset( $params['full'] ) )
		unset( $params['full'] );
	$params['full'] = 0;
	$url = preg_replace( '/\?.*/', '', $url ) . '?' . http_build_query( $params );
	
	wp_localize_script('weever-desktop', 'WDesktop',
			array(
				'url' => $url,						
			)
	);
}

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
		// Handle the full param and skipping mobile detection
		$full = get_query_var( 'full' );
		if ( $full != '' ) { 
			if ( $full == '0' and isset( $_SESSION['ignore_mobile'] ) )
				unset( $_SESSION['ignore_mobile'] );
			
			if ( $full == '1' )
				$_SESSION['ignore_mobile'] = '1';
		}
		
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

		// Show bar along the bottom if mobile device but we're not redirecting
		if ( $weever_app_redirect === true and isset( $_SESSION['ignore_mobile'] ) and $_SESSION['ignore_mobile'] == '1' ) {
			add_action( 'wp_print_scripts', 'weever_desktop_print_scripts' );
		}

		if ( isset( $_SESSION['ignore_mobile'] ) and $_SESSION['ignore_mobile'] == '1' )
			return;
		
		if ( $weever_app_redirect === false ) {
			$_SESSION['ignore_mobile'] = '1';
			return;
		}

		// Finally, redirect
		$url = weever_get_redirect_url( $weeverapp );

		if ( ! headers_sent( $filename, $linenum ) ) {
			header( 'Location: ' . $url );
		} else {
			echo "<!-- Headers sent by $filename (line $linenum) --> ";
			die('<a href="'.$url.'">View our mobile web app - click here</a>');
		}

		die();
	}
}

add_action( 'template_redirect', 'weever_init', 0 );

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
	status_header(200);
    load_template( dirname( __FILE__ ) . '/templates/feed-r3s.php' );
}

add_action( 'do_feed_r3s', 'weever_create_r3sfeed', 10, 1 );

function weever_no_limits_for_feed( $val ) {
    global $wp_query;

    if ( isset( $wp_query->query_vars['feed'] ) and ( $wp_query->query_vars['feed'] == 'r3s' ) )
    {
    	// Default values
    	$limit = ( is_numeric( get_query_var( 'limit' ) ) and get_query_var( 'limit' ) > 0 ) ? get_query_var( 'limit' ) : 15;
    	$page = ( is_numeric( get_query_var( 'page' ) ) and get_query_var( 'page' ) > 0 ) ? get_query_var( 'page' ) : 1;
    	$offset = ( is_numeric( get_query_var( 'start' ) ) and get_query_var( 'start' ) > 0 ) ? get_query_var( 'start' ) : ( ( $page - 1 ) * $limit );
    	
    	$val = 'LIMIT ' . $offset . ', ' . $limit;
    	return $val;
    }
	else
		return $val;
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

                // Look for post type before more generic stylesheet
                $post = get_post( get_the_ID() );
                $template_suffixes = array( '-' . $post->post_type, '' );

                foreach ( $template_suffixes as $suffix ) {
    				if ( file_exists( get_stylesheet_directory() . '/weever-content-single' . $suffix . '.php' ) ) {
    					include( get_stylesheet_directory() . '/weever-content-single' . $suffix . '.php' );
    					break;
    				} elseif ( file_exists( get_template_directory() . '/weever-content-single' . $suffix . '.php' ) ) {
    					include( get_template_directory() . '/weever-content-single' . $suffix . '.php' );
    					break;
    				} elseif ( file_exists( dirname( __FILE__ ) . '/templates/weever-content-single' . $suffix . '.php' ) ) {
    		        	include( dirname( __FILE__ ) . '/templates/weever-content-single' . $suffix . '.php' );
    		        	break;
    				}
                }

				$jsonHtml->html =  ob_get_clean();
				$jsonHtml->image = null;

				$html = WeeverSimpleHTMLDomHelper::str_get_html( $jsonHtml->html );

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
				$jsonHtml->html = str_replace( "href=\"http://", "hrefmask=\"weever://", $jsonHtml->html );
				$jsonHtml->html = str_replace( "href='http://", "hrefmask='weever://", $jsonHtml->html );
				
				// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
				$jsonHtml->html = str_replace( "target=\"_blank\"", "", $jsonHtml->html );
				$jsonHtml->html = str_replace( "target='_blank'", "", $jsonHtml->html );
				
				//$jsonHtml->html = str_replace( "href=\"", "target=\"_blank\" href=\"", $jsonHtml->html );
				//$jsonHtml->html = str_replace("src=\"/", "src=\"".get_site_url()."/", $jsonHtml->html);
				//$jsonHtml->html = str_replace("src=\"images", "src=\"".get_site_url()."/images", $jsonHtml->html);

				// Change all links to absolute vs. relative
				// http://wintermute.com.au/bits/2005-09/php-relative-absolute-links/
                $jsonHtml->html = preg_replace( '#(href|src)="([^:"]*)("|(?:(?:%20|\s|\+)[^"]*"))#', '$1="' . get_site_url() . '$2$3', $jsonHtml->html );
                $jsonHtml->html = preg_replace( '#(href|src)=\'([^:\']*)(\'|(?:(?:%20|\s|\+)[^\']*\'))#', '$1=\'' . get_site_url() . '$2$3', $jsonHtml->html );
                
				// Restore external links, ensure target="_blank" applies
				$jsonHtml->html = str_replace( "hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);
				$jsonHtml->html = str_replace( "hrefmask='weever://", "target=\"_blank\" href='http://", $jsonHtml->html);
				$jsonHtml->html = str_replace( "<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
													"<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html );

				// Add full=1 to the end of all links
                $jsonHtml->html = preg_replace( '#(href)=("|\')http([^?\2]+)(\?+)(.*)\2#', '$1=$2http$3$4$5&full=1$2', $jsonHtml->html );
                //$jsonHtml->html = preg_replace( '#(href)=("|\')http(.*)(?)([^("|\')]*)\2#', '$1=$2http$3$4$5&full=1$2', $jsonHtml->html );
                $jsonHtml->html = preg_replace( '#(href)=("|\')http([^?\2]+)\2#', '$1=$2http$3?full=1$2', $jsonHtml->html );
                
				$jsonOutput = new jsonOutput;
				$jsonOutput->results[] = $jsonHtml;
				$output = json_encode( $jsonOutput );

				if ( $callback )
					$json = $callback . '(' . $output . ')';
				else
					$json = $output;

				status_header( 200 );
				
				print_r( $json );

		        exit;

    		case 'weever_css':

				header('Content-type: text/css');
				header('Cache-Control: no-cache, must-revalidate');

				if ( file_exists( get_stylesheet_directory() . '/weever.css' ) )
					include( get_stylesheet_directory() . '/weever.css' );
				elseif ( file_exists( get_template_directory() . '/weever.css' ) )
					include( get_template_directory() . '/weever.css' );

				exit;
				
    		case 'weever_version':
    			die( var_dump( WeeverConst::VERSION ) );
    	}
    }
}

add_action('template_redirect', 'weever_app_request');

/**
 * Additional query variables needed by Weever Apps
 */
function weever_query_vars($vars) {
    $vars[] = 'template';

    // For pagination in the r3s feed
    $vars[] = 'limit';
    $vars[] = 'start';
    $vars[] = 'page';

    // For including a callback function for R3S feed/document
    $vars[] = 'callback';
    $vars[] = 'full';
    
    return $vars;
}

add_filter('query_vars', 'weever_query_vars');