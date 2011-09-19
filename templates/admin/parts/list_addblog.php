<div class="wx-add-ui">
	<div class='wx-add-item-blog wx-add-item-dropdown'>
		<select id='wx-select-blog' name="wx-select-blog">
			<option value=""><?php echo __( '+ Add Blog Content' ); ?></option>
			<?php foreach ( get_taxonomies( array( 'public' => true ), 'objects' ) as $taxonomy ): ?>
			<?php if ( ! $taxonomy->query_var || $taxonomy->query_var == 'post_format' ) continue; ?>
			<option value="<?php echo $taxonomy->query_var; ?>"><?php echo sprintf( __( 'From taxonomy: %s' ), $taxonomy->label ); ?></option>
			<?php endforeach; ?>
			<option value="s"><?php echo __( 'From a Search Term' ); ?></option>
		</select>
	</div>

	<div class='wx-dummy wx-blog-dummy'>
		<select disabled='disabled'><option><?php echo __( '&nbsp;' ); ?></option></select>
	</div>

	<div class='wx-dummy wx-blog-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo __( '&nbsp;' ); ?>' />
	</div>

	<div class='wx-add-item-option wx-blog-reveal wx-reveal'>

		<?php foreach ( get_taxonomies( array( 'public' => true ), 'objects' ) as $taxonomy ): ?>
		<?php if ( ! $taxonomy->query_var || $taxonomy->query_var == 'post_format' ) continue; ?>
		<div id="wx-add-blog-<?php echo $taxonomy->query_var; ?>-item" class="wx-blog-item-choose">
    		<select id="wx-add-blog-<?php echo $taxonomy->query_var; ?>-select" name="unnamed" class="wx-blog-item-select required">
    			<option value=""><?php echo __( '(Choose an option)' ); ?></option>
            	<?php foreach ( get_terms( $taxonomy->name ) as $term ): ?>
    			<option value="<?php echo WeeverHelper::get_term_feed_link_relative( $term ); ?>"><?php echo $term->name; ?></option>
            	<?php endforeach; ?>
    		</select>
    	</div>
		<?php endforeach; ?>

		<div id="wx-add-blog-s-item" class="wx-blog-item-choose">
    		<input type='text' value='' id='wx-add-blog-s-input' class='wx-input wx-blog-input' name='s' placeholder='<?php echo __( 'Search Term' ); ?>' />
    		<label for='wx-add-blog-s-input' id='wx-add-blog-s-input-label' class='wx-blog-label'><?php echo __( 'Search Term Description' ); ?></label>
		</div>

	</div>

	<div class='wx-add-title wx-blog-reveal wx-reveal'>

		<input type='text' id='wx-blog-title' value='' class='wx-title wx-input wx-blog-input' name='noname' />
		<label for='wx-blog-title'><?php echo __( 'Submenu Tab Name/Description' ); ?></label>
	</div>

	<div class='wx-add-submit'>
		<input type='submit' id='wx-blog-submit' class='wx-submit' value='<?php echo __( 'Submit' ); ?>' name='add' />
	</div>

</div>