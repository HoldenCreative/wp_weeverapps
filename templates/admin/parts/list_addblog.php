
		<?php foreach ( get_taxonomies( array( 'public' => true, 'show_in_nav_menus' => true ), 'objects' ) as $taxonomy ): ?>
			<h3><?php echo $taxonomy->label; ?></h3>
        	<select name="cms_feed">
        	<?php foreach ( get_terms( $taxonomy->name ) as $term ): ?>
			<option value="<?php
			    $feed = 'r3s';
			    $term_id = $term->term_id;
			    $taxonomy = $term->taxonomy;
				if ( 'category' == $taxonomy ) {
        			$link = "index.php?feed=$feed&amp;cat=$term_id";
        		}
        		elseif ( 'post_tag' == $taxonomy ) {
        			$link = "index.php?feed=$feed&amp;tag=$term->slug";
        		} else {
        			$t = get_taxonomy( $taxonomy );
        			$link = "index.php?feed=$feed&amp;$t->query_var=$term->slug";
        		}
                  echo $link;

			//echo get_term_feed_link( $term ); ?>"><?php echo $term->name; ?></option>
        	<?php endforeach; ?>
    		</select>
		<?php endforeach; ?>