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

define('WEEVER_VERSION', '0.1');
define('WEEVER_PLUGIN_URL', plugin_dir_url( __FILE__ ));

if ( ! function_exists( 'add_action' ) ) {
	echo "Plugin file cannot be called directly.";
	exit;
}

// TODO: Check for earliest WP version tested and functional

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';

function weever_init() {

    // Initialize the session
    if ( ! session_id() )
	    session_start();
    
	// Check if a feed or the admin site is being accessed
	if ( is_feed() || is_admin() )
	    return;

	// Verify the app is enabled
	if ( get_option( 'weever_api_key' ) && get_option( 'weever_app_enabled' ) )
	{
	    // Run the mobile checks
	    die('here');
	}
}

add_action( 'init', 'weever_init', 0 );

/*
 * i18n handing
 */

function weever_parse_request($wp) {
    // only process requests with "weever=i18n" and later "weever=ajax..."
    if ( array_key_exists('weever', $wp->query_vars) && $wp->query_vars['weever'] == 'i18n' && isset($wp->query_vars['weever_i18n_file']) ) {
        // process the request.
        function _repl($x) { return '"' . __($x[1]) . '"'; }
        
        $js = file_get_contents( dirname( __FILE__ ) . '/' . $wp->query_vars['weever_i18n_file'] );
        $js = preg_replace_callback( '~_e\("(.+?)"\)~', '_repl', $js );
        echo $js;
        
        // Don't use wp_die(), as it will wrap in a basic template
        die();
    }
}

add_action('parse_request', 'weever_parse_request');

function weever_query_vars($vars) {
    $vars[] = 'weever';
    $vars[] = 'weever_i18n_file';
    return $vars;
}

add_filter('query_vars', 'weever_query_vars');