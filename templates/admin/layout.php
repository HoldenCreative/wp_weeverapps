
<div class="wrap">
    <h2><?php _e('Weever Apps Configuration', 'weever'); ?></h2>

	<script>
    	jQuery(document).ready(function() {
    		jQuery( "#tabs" ).tabs();
    		jQuery( "#toptabs li" ).hover(function(){jQuery(this).addClass('ui-state-hover');}, function(){jQuery(this).removeClass('ui-state-hover');});
    	});
	</script>

    <form action="options.php" method="post">

  	<?php $errors = get_settings_errors(); ?>

	<?php if (is_array($errors)): ?>
    	<?php foreach($errors as $error): ?>
		<div id="message" class="<?php echo $error['type']; ?> fade"><p><strong><?php echo __($error['message'], 'weever'); ?></strong></p></div>
    	<?php endforeach; ?>
    <?php endif; ?>


	<div id="toptabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-list' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-list' ); ?>"><?php _e('App Features and Nativation', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-theme' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-theme' ); ?>"><?php _e('Logo, Images and Theme', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-mobile-publishing' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-mobile-publishing' ); ?>"><?php _e('Mobile Publishing', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-key-config' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-key-config' ); ?>"><?php _e('Subscription Key + Staging Mode', 'weever'); ?></a></li>
			<li class="ui-state-default ui-corner-top<?php echo $page == 'weever-support' ? ' ui-tabs-selected ui-state-active' : ''; ?>"><a href="<?php echo admin_url( 'admin.php?page=weever-support' ); ?>"><?php _e('Support, Feedback and News', 'weever'); ?></a></li>
		</ul>
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
		<?php require( $content ); ?>
		</div>
	</div>


    </form>


</div>

