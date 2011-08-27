<?php
//add_action( 'admin_menu', 'weever_config_page' );
add_action('admin_menu', 'weever_admin_add_page');

weever_admin_warnings();

function weever_admin_warnings() {
	if ( ! get_option( 'weever_api_key' ) && ! isset( $_POST['submit']) ) {
		function weever_warning() {
			echo "
			<div id='weever-warning' class='updated fade'><p><strong>".__('Weever is almost ready.')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Weever API key</a> for it to work.'), "plugins.php?page=weever-key-config")."</p></div>
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
            <div id='weever-warning' class='updated fade'><p><strong>".sprintf(__('Weever %s requires WordPress 3.0 or higher.'), WEEVER_VERSION) ."</strong> ".sprintf(__('Please <a href="%s">upgrade WordPress</a> to a current version.'), 'http://codex.wordpress.org/Upgrading_WordPress'). "</p></div>
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
	wp_register_script( 'weever.js', WEEVER_PLUGIN_URL . 'weever.js', array( 'jquery' ) );
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
	if ( ! preg_match('/^[a-z0-9]{6}$/i', $weever_api_key)) {
	    $weever_api_key = '';
	    add_settings_error('weever_api_key', 'weever_settings', 'Invalid Weever API key');
    } else {
        add_settings_error('weever_api_key', 'weever_settings', 'Weever API key saved and updated', 'updated');
    }

	return $weever_api_key;
}

function weever_admin_add_page() {
    if ( function_exists('add_submenu_page') )
		add_submenu_page('plugins.php', __('Weever Configuration'), __('Weever Configuration'), 'manage_options', 'weever-key-config', 'weever_conf');
}

function weever_conf() {
	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && ! current_user_can('manage_options') )
			die(__('Access denied'));
			
	    
	}

?>

<div class="wrap">
    <h2><?php _e('Weever Apps Configuration'); ?></h2>
    <form action="options.php" method="post">
    	<?php $errors = get_settings_errors(); ?>
    	<?php if (is_array($errors)): ?>
	    	<?php foreach($errors as $error): ?>
			<div id="message" class="<?php echo $error['type']; ?> fade"><p><strong><?php echo __($error['message']); ?></strong></p></div>
	    	<?php endforeach; ?>
	    <?php endif; ?>
        <?php settings_fields('weever_options'); ?>
        <?php do_settings_sections('weever'); ?>
        <input name="submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
    </form>
</div>
<?php 
}
