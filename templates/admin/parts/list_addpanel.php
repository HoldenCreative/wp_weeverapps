<form action='' method='post' name='panelAdminForm' id='panelAdminForm'>

<div class="wx-add-ui formspacer">
	<div class='wx-add-item-panel wx-add-item-dropdown'>
		<select id='wx-select-panel' name='wx-select-panel'>
			<option value=''><?php echo __( '+ Add Site Page(s)', 'weever' ); ?></option>
			<option value='menu'><?php echo __( 'Wordpress Page', 'weever' ); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-panel-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;', 'weever' ); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-panel-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;', 'weever' ); ?>' />
	</div>

	<div class='wx-add-item-value wx-panel-reveal wx-reveal'>
		<select id="wx-add-panel-menu-item-select" class="wx-panel-feed-select" name="cms_feed">
			<option value=""><?php echo __( '(Choose a Content Item)', 'weever' ); ?></option>
			<?php foreach ( get_pages() as $page ): ?>
			<option value="<?php echo WeeverHelper::get_page_link_relative( $page ); ?>"><?php echo $page->post_title; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	
	<div class='wx-add-title wx-panel-reveal wx-reveal'>
		<input type='text' value='' id='wx-panel-title' class='wx-title wx-input wx-panel-input' name='noname' />
		<label for='wx-panel-title'><?php echo __( 'Page Name', 'weever' ); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-panel-submit' class='wx-submit' value='<?php echo __( 'Submit', 'weever' ); ?>' name='add' />
	</div>

</div>

</form>