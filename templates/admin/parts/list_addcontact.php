<form action='' method='post' name='contactAdminForm' id='contactAdminForm'>

<div class="wx-add-ui">
	<div class='wx-add-item-contact wx-add-item-dropdown'>
		<select id='wx-select-contact' name='wx-select-contact'>
			<option value=''><?php echo __( '+ Add Contact Information' ); ?></option>
			<option value='jcontact'><?php echo __( 'Wordpress User Account' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-contact-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;') ; ?></option></select>
	</div>
	
	<div class='wx-dummy wx-contact-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __('&nbsp;'); ?>' />
	</div>

	
	<div class='wx-add-item-value wx-contact-reveal wx-reveal'>
	
		<select name="component_id" id="wx-add-contact-wordpress-select" class="wx-component-id-select">
			<option value="">Choose a Contact</option>
        	<?php foreach ( get_users() as $user ): ?>
			<option value="<?php echo WeeverHelper::get_user_link_relative( $user ); ?>"><?php echo $user->display_name; ?></option>
        	<?php endforeach; ?>			
		</select>
        <label for='wx-add-contact-wordpress-select'><?php echo __( 'Wordpress Users' ); ?></label>
	
	</div>
	
	<div class='wx-add-title wx-contact-reveal wx-reveal'>
		<input type='text' value='' id='wx-contact-title' class='wx-title wx-input wx-contact-input' name='noname' />
		<label for='wx-contact-title'><?php echo __( 'Contact Name' ); ?></label>
	</div>
	
	<div class='wx-contact-options wx-contact-reveal wx-reveal'>
		<input type="checkbox" name="emailform" id="wx-contact-option-email-form" value="1" /> 
		<label for="wx-contact-option-email-form" class="key hasTip" title="<?php echo __( '<strong>Note:</strong> Hides the email address, except on BlackBerry phones which have a form bug and where a direct email link is the only option.' ); ?>"><?php echo __( 'Use an email form*' ); ?></label>
		<br/>
		<input type="checkbox" name="googlemaps" id="wx-contact-option-google-maps" value="1" /> 
		<label for="wx-contact-option-google-maps"><?php echo __( 'Display a Google Maps&trade; link' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-contact-submit' class='wx-submit' value='<?php echo __( 'Submit' ); ?>' name='add' />
	</div>

</div>

</form>