


    <input name="submit" type="submit" value="<?php _e('Save Changes', 'weever'); ?>" />

    <div id="tabs">
    	<ul>
    		<li><a href="#tabs-1"><?php _e('Account Information', 'weever'); ?></a></li>
    		<li><a href="#tabs-2"><?php _e('Staging Mode (Advanced)', 'weever'); ?></a></li>
    	</ul>
    	<div id="tabs-1">
            <table>
            <tr valign="top">
            <th scope="row">Upload Image</th>
            <td><label for="upload_image">
            <input id="upload_image" type="text" size="36" name="upload_image" value="" />
            <input id="upload_image_button" type="button" value="Upload Image" />
            <br />Enter an URL or upload an image for the banner.
            </label></td>
            </tr>
            </table>

            <?php settings_fields('weever_options'); ?>
            <?php do_settings_sections('weever'); ?>

    	</div>
    	<div id="tabs-2">
    		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
    		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    	</div>
    </div>
