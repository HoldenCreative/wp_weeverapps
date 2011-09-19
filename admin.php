<?php
add_action('admin_menu', 'weever_admin_add_page');

weever_admin_warnings();

/**
 * Add the administration pages for Weever Apps. Uses the admin_print_scripts action to ensure
 * the javascript/css is only loaded on our configuration screens.
 */
function weever_admin_add_page() {
    if ( function_exists('add_menu_page') )
    {
        // Ensure there are no directory references
        $page = basename( $_GET['page'] );

        // If this is a weever page, add it as the admin menu item (so it is always highlighted properly between admin page tabs)
        if ( substr( $page, 0, strlen('weever-') ) == 'weever-' && file_exists( dirname( __FILE__ ) . '/templates/admin/tabs/' . str_replace( 'weever-', '', $page ) . '.php' ) )
        {
    		$mypage = add_menu_page(__('Weever Apps Configuration', 'weever'), __('Weever Apps Configuration', 'weever'), 'manage_options', $page, 'weever_admin_page', '');
    		add_action( "admin_print_scripts-$mypage", 'weever_page_scripts_init' );
    		add_action( "admin_print_styles-$mypage", 'weever_page_styles_init' );
        }
        else
        {
//    		$mypage = add_submenu_page('', __('Weever Apps Configuration', 'weever'), __('App Features and Navigation', 'weever'), 'manage_options', 'weever-tabs', 'weever_conf');
    		$mypage = add_menu_page(__('Weever Apps Configuration', 'weever'), __('Weever Apps Configuration', 'weever'), 'manage_options', 'weever-account', 'weever_admin_page', '');
            add_action( "admin_print_scripts-$mypage", 'weever_page_scripts_init' );
    		add_action( "admin_print_styles-$mypage", 'weever_page_styles_init' );
        }
	}
}

/**
 * Page controller, loads the wrapper layout and the indivdual page content
 *
 * TODO: Wrap all tabs into one so they can flip between them sans refresh?
 */
function weever_admin_page() {

	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && ! current_user_can('manage_options') )
			die( __( 'Access denied', 'weever' ) );

        // Most form control handled via AJAX calls rather than direct post
        // TODO: Any additional post handling here
	}

	// Set the content
	// Should never get here without the page get var being set
	// TODO: Create a WeeverView class wrapper to pass arbitrary options to the view?
	$page = basename( $_GET['page'] );
	$content = dirname( __FILE__ ) . '/templates/admin/tabs/' . str_replace( 'weever-', '', $page ) . '.php';

	// Load the weeverapp object, which fetches the admin page content
    $weeverapp = new WeeverApp();

	if ( ! file_exists( $content ) )
	    die( __( 'Invalid page given', 'weever' ) );

	// Include the main content to fire things off
	require( dirname( __FILE__) . '/templates/admin/layout.php' );
}

function weever_admin_warnings() {
	if ( ! get_option( 'weever_api_key' ) && ! isset( $_POST['submit']) ) {
		function weever_warning() {
			echo "
			<div id='weever-warning' class='updated fade'><p><strong>".__('Weever Apps is almost ready.', 'weever')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Weever Apps API key</a> for it to work.', 'weever'), "plugins.php?page=weever-account")."</p></div>
			";
		}
		add_action( 'admin_notices', 'weever_warning' );
		return;
	}
}

function weever_admin_init() {
    global $wp_version;

    // all admin functions are disabled in old versions
    if ( ! function_exists( 'is_multisite' ) && version_compare( $wp_version, '3.0', '<' ) ) {

        function weever_version_warning() {
            echo "
            <div id='weever-warning' class='updated fade'><p><strong>".sprintf(__('Weever Apps %s requires WordPress 3.0 or higher.', 'weever'), WEEVER_VERSION) ."</strong> ".sprintf(__('Please <a href="%s">upgrade WordPress</a> to a current version.', 'weever'), 'http://codex.wordpress.org/Upgrading_WordPress'). "</p></div>
            ";
        }
        add_action( 'admin_notices', 'weever_version_warning' );

        return;
    }

    register_setting( 'weever_options', 'weever_api_key', 'weever_api_key_validate' );
    add_settings_section( 'weever_main', __('Weever Apps Settings'), 'weever_section_text', 'weever' );
    add_settings_field( 'weever_api_key', __('Weever Apps API Key'), 'weever_api_key_string', 'weever', 'weever_main' );
}

add_action( 'admin_init', 'weever_admin_init' );

/**
 * Load styles needed for Weever Apps
 */
function weever_page_styles_init() {
	wp_register_style( 'weever.css', WEEVER_PLUGIN_URL . 'static/css/weever.css' );
	wp_register_style( 'jquery-ui.css', WEEVER_PLUGIN_URL . 'static/css/jquery-ui.css' );
	wp_register_style( 'jquery-ui-new.css', WEEVER_PLUGIN_URL . 'static/css/jquery-ui-new.css' );
	wp_register_style( 'jquery-impromptu.css', WEEVER_PLUGIN_URL . 'static/css/jquery-impromptu.css' );
	wp_enqueue_style( 'jquery-ui.css' );
	wp_enqueue_style( 'jquery-ui-new.css' );
	wp_enqueue_style( 'jquery-impromptu.css' );
	wp_enqueue_style( 'weever.css' );
	wp_enqueue_style( 'thickbox' );
}

/**
 * Loads scripts needed for Weever Apps
 */
function weever_page_scripts_init() {
    wp_register_script( 'jquery-impromptu.js', plugins_url( 'static/js/jquery-impromptu.js', __FILE__ ) );
    wp_enqueue_script( 'jquery-impromptu.js' );

    wp_register_script( 'jquery-validate.js', plugins_url( 'static/js/jquery.validate.min.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_script( 'jquery-validate.js' );

	wp_register_script( 'weever.js', plugins_url( 'static/js/weever.js', __FILE__ ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-sortable' ) );
	wp_enqueue_script( 'weever.js' );
	wp_localize_script( 'weever.js', 'WPText', WeeverHelper::get_js_strings() );

	// Page-specific scripts
	if ( isset( $_GET['page'] ) )
	{
    	$page = basename( $_GET['page'] );

    	switch ( $page ) {
    	    case 'weever-account':
                wp_register_script( 'weever.account.js', plugins_url( 'static/js/account.js', __FILE__ ) );
                wp_enqueue_script( 'weever.account.js' );
                wp_localize_script( 'weever.account.js', 'WPText', WeeverHelper::get_js_strings() );
                break;

            case 'weever-list':
                wp_register_script( 'weever.list_icons.js', plugins_url( 'static/js/list_icons.js', __FILE__ ) );
                wp_enqueue_script( 'weever.list_icons.js' );
                wp_localize_script( 'weever.list-icons.js', 'WPText', WeeverHelper::get_js_strings() );

                wp_register_script( 'weever.list_select.js', plugins_url( 'static/js/list_select.js', __FILE__ ) );
                wp_enqueue_script( 'weever.list_select.js' );
//                wp_localize_script( 'weever.list_select.js', 'WPText', WeeverHelper::get_js_strings() );

                wp_register_script( 'weever.list_submit.js', plugins_url( 'static/js/list_submit.js', __FILE__ ) );
                wp_enqueue_script( 'weever.list_submit.js' );
//                wp_localize_script( 'weever.list_submit.js', 'WPText', WeeverHelper::get_js_strings() );

                wp_register_script( 'weever.list.js', plugins_url( 'static/js/list.js', __FILE__ ) );
                wp_enqueue_script( 'weever.list.js' );
//                wp_localize_script( 'weever.list.js', 'WPText', WeeverHelper::get_js_strings() );
                break;

    	    case 'weever-theme':
                wp_register_script( 'weever.theme.js', plugins_url( 'static/js/theme.js', __FILE__ ) );
                wp_enqueue_script( 'weever.theme.js' );
                wp_localize_script( 'weever.theme.js', 'WPText', WeeverHelper::get_js_strings() );
                break;

            case 'weever-config':
                wp_register_script( 'weever.config.js', plugins_url( 'static/js/config.js', __FILE__ ) );
                wp_enqueue_script( 'weever.config.js' );
                wp_localize_script( 'weever.config.js', 'WPText', WeeverHelper::get_js_strings() );
                break;

            case 'weever-support':
    	        break;

            default:
                wp_die();
    	}
	}

	// Needed for uploaders
	wp_enqueue_script( 'media-upload' );
    wp_enqueue_script( 'thickbox' );
}

function weever_app_toggle() {
    echo '<div>';
    if ( get_option( 'weever_app_enabled' ) ) {
        echo '<b>' . __( 'Weever App Enabled', 'weever' ) . '</b> | <a href="#">' . __( 'Disable' ) . '</a>';
    } else {
        echo '<b>' . __( 'Weever App Disabled', 'weever' ) . '</b> | <a href="#">' . __( 'Enable' ) . '</a>';
    }
    echo '</div>';
}

add_action( 'admin_notices', 'weever_app_toggle' );

function weever_section_text() {
	echo '<p></p>';
}

function weever_api_key_string() {
    $weever_api_key = get_option( 'weever_api_key' );
    echo "<input id='weever_api_key' name='weever_api_key' size='40' type='text' value='$weever_api_key' />";
}

function weever_api_key_validate($weever_api_key) {
	$weever_api_key = trim($weever_api_key);

	// Test getting the data using this api key
	// TODO: Give either the stage URL or blank if live
	$stage_url = "";

	$postdata = http_build_query(
			array(
				'stage' => $stage_url,
				'app' => 'json',
				'site_key' => $weever_api_key,
				'm' => "tab_sync",
				'version' => WeeverConst::VERSION,
				'generator' => WeeverConst::NAME
				)
			);

	$result = wp_remote_get( WeeverConst::LIVE_SERVER."?".$postdata );

	if ( is_array( $result ) and isset( $result['body'] ) )
	{
	    $state = json_decode($result['body']);

    	if ( "Site key missing or invalid." == $result['body'] )
    	{
    	    $weever_api_key = '';
    	    add_settings_error('weever_api_key', 'weever_settings', 'Invalid Weever API key');
        } else {
            add_settings_error('weever_api_key', 'weever_settings', "Weever Apps API key saved and updated - ".$state->results->config->primary_domain, 'updated');
        }
	}
	else
	{
	    add_settings_error('weever_api_key', 'weever_settings', 'Weever API key could not be verified');
	}

	return $weever_api_key;
}

