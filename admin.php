<?php
//add_action( 'admin_menu', 'weever_config_page' );
add_action('admin_menu', 'weever_admin_add_page');

weever_admin_warnings();

function weever_admin_warnings() {
	if ( ! get_option( 'weever_api_key' ) && ! isset( $_POST['submit']) ) {
		function weever_warning() {
			echo "
			<div id='weever-warning' class='updated fade'><p><strong>".__('Weever is almost ready.', 'weever')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Weever API key</a> for it to work.', 'weever'), "plugins.php?page=weever-key-config")."</p></div>
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
            <div id='weever-warning' class='updated fade'><p><strong>".sprintf(__('Weever %s requires WordPress 3.0 or higher.', 'weever'), WEEVER_VERSION) ."</strong> ".sprintf(__('Please <a href="%s">upgrade WordPress</a> to a current version.', 'weever'), 'http://codex.wordpress.org/Upgrading_WordPress'). "</p></div>
            ";
        }
        add_action( 'admin_notices', 'weever_version_warning' );

        return;
    }

    register_setting( 'weever_options', 'weever_api_key', 'weever_api_key_validate' );
    add_settings_section( 'weever_main', __('Weever Settings'), 'weever_section_text', 'weever' );
    add_settings_field( 'weever_api_key', __('Weever API Key'), 'weever_api_key_string', 'weever', 'weever_main' );

	wp_register_style( 'weever.css', WEEVER_PLUGIN_URL . 'weever.css' );
	wp_enqueue_style( 'weever.css' );
	wp_register_script( 'weever.js', site_url() . '?weever=i18n&weever_i18n_file=weever.js', array( 'jquery' ) );
	wp_enqueue_script( 'weever.js' );
}
add_action( 'admin_init', 'weever_admin_init' );

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
            add_settings_error('weever_api_key', 'weever_settings', "Weever API key saved and updated - ".$state->results->config->primary_domain, 'updated');
        }
	}
	else
	{
	    add_settings_error('weever_api_key', 'weever_settings', 'Weever API key could not be verified');
	}

	return $weever_api_key;
}

function weever_admin_add_page() {
    if ( function_exists('add_submenu_page') )
		add_submenu_page('plugins.php', __('Weever Configuration', 'weever'), __('Weever Configuration', 'weever'), 'manage_options', 'weever-key-config', 'weever_conf');
}

function weever_conf() {
	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && ! current_user_can('manage_options') )
			die(__('Access denied', 'weever'));


	}

?>

<div class="wrap">
    <h2><?php _e('Weever Apps Configuration', 'weever'); ?></h2>
    <form action="options.php" method="post">
    	<?php $errors = get_settings_errors(); ?>
    	<?php if (is_array($errors)): ?>
	    	<?php foreach($errors as $error): ?>
			<div id="message" class="<?php echo $error['type']; ?> fade"><p><strong><?php echo __($error['message'], 'weever'); ?></strong></p></div>
	    	<?php endforeach; ?>
	    <?php endif; ?>
        <?php settings_fields('weever_options'); ?>
        <?php do_settings_sections('weever'); ?>
        <input name="submit" type="submit" value="<?php _e('Save Changes', 'weever'); ?>" />
    </form>
</div>
<?php
}
