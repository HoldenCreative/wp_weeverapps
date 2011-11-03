<form action='' method='post' name='pageAdminForm' id='pageAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-page wx-add-item-dropdown'>
		<select id='wx-select-page' name='wx-select-page'>
			<option value=''><?php echo __( '+ Add Site Page(s)' ); ?></option>
			<option value='menu'><?php echo __( 'Wordpress Page' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-page-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-page-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;' ); ?>' />
	</div>

	<div class='wx-add-item-value wx-page-reveal wx-reveal'>
		<select id="wx-add-page-menu-item-select" class="wx-cms-feed-select" name="cms_feed">
			<option value=""><?php echo __( '(Choose a Content Item)' ); ?></option>
			<?php foreach ( get_pages() as $page ): ?>
			<option value="<?php echo WeeverHelper::get_page_link_relative( $page ); ?>"><?php echo $page->post_title; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	
	<div class='wx-add-title wx-page-reveal wx-reveal'>
		<input type='text' value='' id='wx-page-title' class='wx-title wx-input wx-page-input' name='noname' />
		<label for='wx-page-title'><?php echo __( 'Page Name' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-page-submit' class='wx-submit' value='<?php echo __( 'Submit' ); ?>' name='add' />
	</div>

</div>

</form>