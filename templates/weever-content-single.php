<?php
// the_post() has already been called by Weever Controller
?>
<div class="item-page">

<h1 class="wx-article-title">
	<?php echo get_the_title(); ?>
</h1>

	<?php if ( ! is_page() ): ?>
		
		<dd class="category-name">
		<?php echo sprintf(__('Categories: %s', 'weever'), get_the_category_list(' ')); ?>
		</dd>
	
		<dd class="published">
		<?php echo sprintf(__('Published: %s', 'weever'), get_the_time(get_option('date_format'))); ?>
		</dd>
	
		<dd class="createdby">
		<?php echo sprintf(esc_attr__('Written by: %s', 'weever'), get_the_author_link()); ?>
		</dd>

	<?php endif; ?>

<p>
<?php the_content(); ?>
</p>
</div>
