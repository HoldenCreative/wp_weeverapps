
<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>


<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>

    <input name="submit" type="submit" value="<?php _e( 'Save Changes', 'weever' ); ?>" />

	<?php wp_nonce_field( 'weever_settings', 'weever_settings_nonce' ); ?>

    <div id="tabs">
    	<ul>
    		<li><a href="#tabs-1"><?php _e( 'Basic Settings', 'weever' ); ?></a></li>
    		<li><a href="#tabs-2"><?php _e( 'Advanced Device Settings', 'weever' ); ?></a></li>
    	</ul>
    	<div id="tabs-1">
        	<div>
        		<fieldset>
        			<legend><?php echo __( 'Smartphone + Tablet Publishing', 'weever' ); ?></legend>

            		<table class="admintable">

                		<tr>
                			<td class="key hasTip" title="<?php echo __('When you app is online, smartphones like the iPhone (and iPod Touch), Blackberry Touch phones, and Android phones will be forwarded to your app.', 'weever' ); ?>"><?php echo __( 'Enable Smartphones?', 'weever' ); ?></td>
                    		<td>
                        		<select name="DetectTierWeeverSmartphones">
                        		<option value="0"><?php echo __('NO'); ?></option>
                        		<option value="1" <?php echo ($weeverapp->DetectTierWeeverSmartphones ? "SELECTED" : ""); ?>><?php echo __( 'YES', 'weever' ); ?></option>
                        		</select>
                    		</td>
                		</tr>

                		<tr>
                			<td class="key hasTip" title="<?php echo __( 'When your app is online, tablets with Android, Blackberry OS 6+, and iOS will be forwarded to your app.', 'weever' ); ?>"><?php echo __( 'Enable iPad&trade; + tablets?', 'weever' ); ?></td>
                    		<td>
                        		<select name="DetectTierWeeverTablets">
                        		<option value="0"><?php echo __( 'NO', 'weever' ); ?></option>
                        		<option value="1" <?php echo ($weeverapp->DetectTierWeeverTablets ? "SELECTED" : ""); ?>><?php echo __( 'YES', 'weever' ); ?></option>
                        		</select>
                    		</td>
                		</tr>

            		</table>

        		</fieldset>

            	<fieldset class='adminForm'>
                	<legend><?php echo __('Additional Services'); ?></legend>

                	<table class="admintable">
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( "Paste in your code from Google Analytics to track visitors to your app", 'weever' ); ?>"><?php echo __( 'Google Anayltics User-Agent (UA) Code', 'weever' ); ?></td>
                        	<td><input type="textbox" name="google_analytics" value="<?php echo $weeverapp->google_analytics; ?>" id="wx-google-analytics-input" placeholder="UA-XXXXXX-XX" /></td>
                    	</tr>

                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( "Enable to allow us to list your app on our directory, the Weever Ecosystem.", 'weever' ); ?>"><?php echo __( 'Weever Ecosystem', 'weever' ); ?></td>
                        	<td><input type="checkbox" name="ecosystem" value="1" <?php echo ($weeverapp->ecosystem == 1 ? "checked='checked'":""); ?>" /> <label for="checkEcosystem"><?php echo sprintf( __( 'List your app in the <a href="%s" target="_blank">Weever Ecosystem</a>?', 'weever' ), 'http://weeverapps.zendesk.com/entries/20244138-what-is-the-weever-ecosystem' ); ?></label></td>
                    	</tr>

                	</table>
                </fieldset>

                <fieldset class='adminForm'>
                	<legend><?php echo __( 'Weever Apps Pro Features', 'weever' ); ?></legend>

                	<p><?php echo sprintf( __("<a href='%s' target='_blank'>Weever Apps Pro (white-label)</a> allows you to use your own custom address for your app, such as http://app.yoursitename.com/. Please see our <a href='%s' target='_blank'>notes on how to map a domain or sub-domain to your app</a>.", 'weever' ), 'http://weeverapps.com/joomla', 'http://weeverapps.zendesk.com/entries/20394158-how-do-i-use-my-own-domain-name-web-site-address-url-with-weever-apps' ); ?></p>

                	<table class="admintable">

                	<tr>
                	<td class="key hasTip" title="<?php echo __( "Use this to set up app.yourname.com or yourappname.com", 'weever' ); ?>"><?php echo __( 'Domain Mapping', 'weever' ); ?></td>
                	<td><input type="textbox" name="domain"  value="<?php echo $weeverapp->domain; ?>" id="wx-domain-map-input" placeholder="app.yourdomain.com" /> </td>
                	</tr>


                	</table>
            	</fieldset>
        	</div>
		</div>

    	<div id="tabs-2">
    		<div>

        		<fieldset>
        			<legend><?php echo __( 'Advanced Device Settings', 'weever' ); ?></legend>

            		<div><input type="checkbox" value="1" class="wx-check" name="granular_devices" id="wx-granular-devices" <?php echo ($weeverapp->granular ? "CHECKED" : ""); ?> /><label class="wx-check-label" for="wx-granular-devices"><?php echo __( 'Use Advanced Device Settings (Replaces Basic Settings)', 'weever' ); ?></label></div>

            		<table class="admintable">

                		<tr><th>&nbsp;</th>
                		<th><?php echo __( 'Status', 'weever' ); ?></th>
                		<th><?php echo __( 'WEEVER_CONFIG_RECOMMENDED', 'weever' ); ?></th>
                		<th><?php echo __( 'WEEVER_CONFIG_COMPATIBILITY_GRADE', 'weever' ); ?></th></tr>



                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_APPLE_IPOD_IPHONE', 'weever' ); ?></td>
                		<td>
                		<select name="DetectIphoneOrIpod">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectIphoneOrIpod ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Enabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_APPLE_IPOD_IPHONE_GRADE', 'weever' ); ?></td>
                		</tr>

                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_GOOGLE_ANDROID', 'weever' ); ?></td>
                		<td>
                		<select name="DetectAndroid">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectAndroid ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Enabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_GOOGLE_ANDROID_GRADE', 'weever' ); ?></td>
                		</tr>

                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_BLACKBERRY_SIX_TOUCH', 'weever' ); ?></td>
                		<td>
                		<select name="DetectBlackBerryTouch">
                		<option value="0"><?php echo __('Disabled'); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectBlackBerryTouch ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Enabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_BLACKBERRY_SIX_TOUCH_GRADE', 'weever' ); ?></td>
                		</tr>

                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_HP_TOUCHPAD', 'weever' ); ?></td>
                		<td>
                		<select name="DetectWebOSTablet">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectTouchPad ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Disabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_HP_TOUCHPAD_GRADE', 'weever' ); ?></td>
                		</tr>


                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_BLACKBERRY_PLAYBOOK', 'weever' ); ?></td>
                		<td>
                		<select name="DetectBlackBerryTablet">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectBlackBerryTablet ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Enabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_BLACKBERRY_PLAYBOOK_GRADE', 'weever' ); ?></td>
                		</tr>


                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_APPLE_IPAD', 'weever' ); ?></td>
                		<td>
                		<select name="DetectIpad">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectIpad ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Enabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_APPLE_IPAD_GRADE', 'weever' ); ?></td>
                		</tr>


                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_GOOGLE_ANDROID_TABLETS', 'weever' ); ?></td>
                		<td>
                		<select name="DetectAndroidTablet">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectAndroidTablet ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Enabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_GOOGLE_ANDROID_TABLETS_GRADE', 'weever' ); ?></td>
                		</tr>



                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_GOOGLE_TV', 'weever' ); ?></td>
                		<td>
                		<select name="DetectGoogleTV">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectGoogleTV ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Disabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_GOOGLE_TV_GRADE', 'weever' ); ?></td>
                		</tr>

                		<tr><td class="key"><?php echo __( 'WEEVER_CONFIG_APPLETV_TWO_JAILBROKEN', 'weever' ); ?></td>
                		<td>
                		<select name="DetectAppleTVTwo">
                		<option value="0"><?php echo __( 'Disabled', 'weever' ); ?></option>
                		<option value="1" <?php echo ($weeverapp->DetectAppleTVTwo ? "SELECTED" : ""); ?>><?php echo __( 'Enabled', 'weever' ); ?></option>
                		</select>
                		</td>
                		<td><?php echo __( 'Disabled', 'weever' ); ?></td>
                		<td><?php echo __( 'WEEVER_CONFIG_APPLETV_TWO_JAILBROKEN_GRADE', 'weever' ); ?></td>
                		</tr>

            		</table>

        		</fieldset>
    		</div>
		</div>
	</div>

	<input type="hidden" name="option" value="<?php //echo $option; ?>" />
	<input type="hidden" name="app_enabled" value="<?php echo $weeverapp->app_enabled; ?>" />
	<input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $weeverapp->site_key; ?>" />
	<input type="hidden" name="view" value="config" />
	<input type="hidden" name="task" value="" />

</form>