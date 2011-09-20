
<div class="wrap">
    <?php if ( $page == 'weever-list' ) : ?>
    <?php
    $onlineSpan = "";
    $offlineSpan = "";

    if ($weeverapp->appEnabled) {
    	$offlineSpan = 'class="wx-app-hide-status"';
    	$offlineStatusClass = "";
    } else {
    	$onlineSpan = 'class="wx-app-hide-status"';
    	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
    }
    ?>

	<div id="wx-app-status-button" <?php echo $offlineStatusClass; ?>><img id="wx-app-status-img" src="<?php echo WEEVER_PLUGIN_URL; ?>static/images/icon_.png?nocache=<?php echo microtime(); ?>" /><br /><span id="wx-app-status-online" <?php echo $onlineSpan; ?>><?php echo __('WEEVER_ONLINE'); ?></span><span id="wx-app-status-offline" <?php echo $offlineSpan; ?>><?php echo __('WEEVER_OFFLINE'); ?></span></div>
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
</div>

