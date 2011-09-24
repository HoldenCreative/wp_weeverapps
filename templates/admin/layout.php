
<div class="wrap">
    <?php if ( $page == 'weever-list' ) : ?>
    <?php
    $onlineSpan = "";
    $offlineSpan = "";

    if ($weeverapp->app_enabled) {
    	$offlineSpan = 'class="wx-app-hide-status"';
    	$offlineStatusClass = "";
    } else {
    	$onlineSpan = 'class="wx-app-hide-status"';
    	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
    }
    ?>

	<div id="wx-app-status-button" <?php echo $offlineStatusClass; ?>><img id="wx-app-status-img" src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icon_.png?nocache=<?php echo microtime(); ?>" /><br /><span id="wx-app-status-online" <?php echo $onlineSpan; ?>><?php echo __( 'App Online', 'weever' ); ?></span><span id="wx-app-status-offline" <?php echo $offlineSpan; ?>><?php echo __( 'App Offline', 'weever' ); ?></span></div>
	<?php endif; ?>

    <h2><?php _e('Weever Apps Configuration', 'weever'); ?></h2>

  	<?php $errors = get_settings_errors(); ?>

	<?php if (is_array($errors)): ?>
    	<?php foreach($errors as $error): ?>
		<div id="message" class="<?php echo $error['type']; ?> fade"><p><strong><?php echo __($error['message'], 'weever'); ?></strong></p></div>
    	<?php endforeach; ?>
    <?php endif; ?>

	<div id="toptabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-list' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-list' ); ?>"><?php _e('App Features + Navigation', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-theme' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-theme' ); ?>"><?php _e('Logo, Images and Theme', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-config' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-config' ); ?>"><?php _e('Mobile Publishing', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-account' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-account' ); ?>"><?php _e('Subscription Key + Staging Mode', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-support' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-support' ); ?>"><?php _e('Support', 'weever'); ?></a></li>
		</ul>
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
		<?php require( $content ); ?>
		</div>
	</div>

	<?php if ( $weeverapp->site_key ): ?>
	<div>
        <div class="wx-qr-app wx-qr-app-private">
        	<?php
        	$weever_server = $weeverapp->staging_mode ? WeeverConst::LIVE_STAGE : WeeverConst::LIVE_SERVER;
        	?>
            <img src="<?php echo $weeverapp->qr_code_private; ?>"  class="wx-qr-imgprev" />

            <div class="wx-qr-textbox">

            <span class="wx-qr-app-text"><?php echo __( 'Test QR Code' ); ?></span>

            <p><?php echo __( 'Scan this private QR code to directly preview your Weever App.' ); ?><br />
    		<?php echo __( 'QR Link:' ); ?> <a href="<?php echo $weever_server; ?>app/<?php echo $weeverapp->primary_domain; ?>"><?php echo $weever_server; ?>app/<?php echo $weeverapp->primary_domain; ?></a></p>

    		<p><?php echo __( 'Additional but <em>imperfect</em> ways to test your app: Use a webkit browser like Google Chrome or Safari, or try the Apple iPhone&trade; simulator.' ); ?></p>


    		</div>
    	</div>

    	<?php if ( ! $weeverapp->staging_mode ): ?>
    	<div class="wx-qr-app wx-qr-app-public">

    		<img src="<?php echo $weeverapp->qr_code_public; ?>"  class="wx-qr-imgprev" />

            <div class="wx-qr-textbox">
                <span class="wx-qr-app-text"><?php echo __( 'Public QR Code'); ?></span>

                <p><?php echo __( 'Share this public QR code to promote your Weever app!' ); ?><br /><?php echo __( 'QR Link:' ); ?> <a href="<?php echo $weeverapp->primary_domain; ?>"><?php echo $weeverapp->primary_domain; ?></a></p>
    			<p><?php echo __( 'Suggested: Business cards, flyers and more!  Be creative!' ); ?></p>
    		</div>
    	</div>
    	<?php else: ?>
    	<div class="wx-qr-app wx-qr-app-public">
    		<?php echo __( 'You are currently in <strong>staging mode</strong>. Public QR Codes are not available for staging mode apps.' ); ?>
    	</div>
    	<?php endif; ?>
    	<div style="clear:both;"></div>
    </div>
	<?php endif; ?>

	<div style="text-align:center;clear:both; margin-top:24px;">
		<?php echo WeeverConst::NAME; ?> v<?php echo WeeverConst::VERSION; ?> <?php echo WeeverConst::RELEASE_TYPE; ?><br />
		<?php echo WeeverConst::COPYRIGHT_YEAR; ?> <a target="_blank" href="<?php echo WeeverConst::COPYRIGHT_URL; ?>"><?php echo WeeverConst::COPYRIGHT; ?></a><br />
		Released <?php echo WeeverConst::RELEASE_DATE; ?> under <a target="_blank" href="<?php echo WeeverConst::LICENSE_URL; ?>"><?php echo WeeverConst::LICENSE; ?></a>.
		<a target="_blank" href="http://weeverapps.zendesk.com/home">Contact Support</a>
	</div>
</div>

