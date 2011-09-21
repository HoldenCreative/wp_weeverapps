
<div class="wx-add-ui">
    <form action="" method="post">

        <input name="submit" type="submit" value="<?php _e( 'Save Changes', 'weever' ); ?>" />

		<?php wp_nonce_field( 'weever_settings', 'weever_settings_nonce' ); ?>

        <div id="tabs">
        	<ul>
        		<li><a href="#tabs-1"><?php _e( 'Account Information', 'weever' ); ?></a></li>
        		<li><a href="#tabs-2"><?php _e( 'Staging Mode (Advanced)', 'weever' ); ?></a></li>
        	</ul>
        	<div id="tabs-1">

            	<div>
                	<fieldset class='adminForm'>
                    	<legend><?php _e( 'Weever Apps Subscription Info', 'weever' ); ?></legend>

                    	<table class="admintable">
                        	<tr><td class="key"><?php _e( 'Subscription Key', 'weever' ); ?></td>
                        	<td><input type="text" name="site_key" maxlength="42" style="width:250px;" value="<?php echo $weeverapp->site_key; ?>" /></td>
                        	</tr>

                        	<tr><td class="key"><?php _e( 'Subscription Domain' ); ?></td>
                        	<td><?php echo sprintf( __( 'This key is linked to the domain <b>%s</b>', 'weever' ), $weeverapp->primary_domain ); ?></td>
                        	</tr>
                    	</table>
                	</fieldset>
            	</div>

        	</div>
        	<div id="tabs-2">
        		<?php if ($weeverapp->staging_mode): ?>
		        <input name="stagingmode" type="submit" value="<?php _e( 'Turn staging mode OFF', 'weever' ); ?>" />
        		<?php else: ?>
		        <input name="stagingmode" type="submit" value="<?php _e( 'Turn staging mode ON', 'weever' ); ?>" />
				<?php endif; ?>

        		<p><?php _e( 'Staging mode creates a separate copy of your Weever App in a test environment. Changes made in staging mode will not affect your public or live app.', 'weever'  ); ?></p>

				<p><?php _e( 'Use staging mode when developing a new site on a test server, or to preview changes in a safely while your Weever App is already online.', 'weever'  ); ?></p>

				<p><?php _e( 'Note: When in staging mode, your private QR Code and URL will update, below.', 'weever'  ); ?></p>
        	</div>
        </div>

    </form>
</div>