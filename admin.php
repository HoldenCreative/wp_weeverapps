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
		$mypage = add_menu_page(__('Weever Apps Configuration', 'weever'), __('Weever Apps Configuration', 'weever'), 'manage_options', 'weever-key-config', 'weever_conf', '');
		add_action( "admin_print_scripts-$mypage", 'weever_page_scripts_init' );
		add_action( "admin_print_styles-$mypage", 'weever_page_styles_init' );

		$mypage = add_submenu_page('', __('Weever Apps Configuration', 'weever'), __('App Features and Navigation', 'weever'), 'manage_options', 'weever-tabs', 'weever_conf');
		add_action( "admin_print_scripts-$mypage", 'weever_page_scripts_init' );
		add_action( "admin_print_styles-$mypage", 'weever_page_styles_init' );
	}
}

function weever_admin_warnings() {
	if ( ! get_option( 'weever_api_key' ) && ! isset( $_POST['submit']) ) {
		function weever_warning() {
			echo "
			<div id='weever-warning' class='updated fade'><p><strong>".__('Weever Apps is almost ready.', 'weever')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Weever Apps API key</a> for it to work.', 'weever'), "plugins.php?page=weever-key-config")."</p></div>
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
	wp_register_script( 'weever.js', site_url() . '?weever=i18n&weever_i18n_file=weever.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ) );

	wp_enqueue_script( 'weever.js' );

	// Needed for uploaders
	wp_enqueue_script( 'media-upload' );
    wp_enqueue_script( 'thickbox' );
}

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

function weever_conf() {

	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && ! current_user_can('manage_options') )
			die(__('Access denied', 'weever'));


	}

?>

<div class="wrap">
    <h2><?php _e('Weever Apps Configuration', 'weever'); ?></h2>

    <form action="options.php" method="post">

<table>
<tr valign="top">
<th scope="row">Upload Image</th>
<td><label for="upload_image">
<input id="upload_image" type="text" size="36" name="upload_image" value="" />
<input id="upload_image_button" type="button" value="Upload Image" />
<br />Enter an URL or upload an image for the banner.
</label></td>
</tr>
</table>

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


<script>
	jQuery(document).ready(function() {
		jQuery( "#tabs" ).tabs();
	});
	</script>



<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Nunc tincidunt</a></li>
		<li><a href="#tabs-2">Proin dolor</a></li>
		<li><a href="#tabs-3">Aenean lacinia</a></li>
	</ul>
	<div id="tabs-1">
		<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
	</div>
	<div id="tabs-2">
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>

</div><!-- End demo -->


</div>



<?php
}
