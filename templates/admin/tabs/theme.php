
<div class="wx-add-ui">
    <form action="" enctype="multipart/form-data" method="post" id="themeAdminForm">

        <input id="wx-theme-submit" name="submit" type="submit" value="<?php _e( 'Save Changes', 'weever' ); ?>" />

        <?php wp_nonce_field( 'weever_settings', 'weever_settings_nonce' ); ?>

        <div id="tabs">
        	<ul>
        		<li><a href="#tabs-1"><?php _e( 'Basic Settings', 'weever' ); ?></a></li>
        		<li><a href="#tabs-2"><?php _e( 'Advanced Theme Settings', 'weever' ); ?></a></li>
        	</ul>
        	<div id="tabs-1">

            	<div>
                	<fieldset class='adminForm'>
                	<legend><?php echo __( 'Basic Settings', 'weever' ); ?></legend>

                	<table class="admintable">
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( 'Changes the design layout of your app. More themes coming soon!', 'weever' ); ?>"><?php echo __( 'Choose a Template', 'weever' ); ?></td>
                        	<td>
                            	<select name="template" class="wx-220-select required">
                            	<option value="sencha" <?php echo ($weeverapp->theme->template == 'sencha' ? "selected='selected'":""); ?>><?php echo __( 'Weever Apps Light&trade;', 'weever' ); ?></option>
                            	</select>
                        	</td>
                    	</tr>
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( 'Selects the method in which the titlebar is generated from.', 'weever' ); ?>"><?php echo __( 'Logo Type', 'weever' ); ?></td>
                        	<td>
                            	<select name="titlebarSource" class="wx-220-select required">
                                	<option value="text" <?php echo ($weeverapp->theme->titlebarSource == 'text' ? "selected='selected'":""); ?>><?php echo __( 'Use Website Name as a Text Title:', 'weever' ); ?> ("<?php echo strip_tags($weeverapp->titlebar_title); ?>")</option>
                                	<option value="image" <?php echo ($weeverapp->theme->titlebarSource == 'image' ? "selected='selected'":""); ?>><?php echo __( 'Use Logo Image (upload below)', 'weever' ); ?></option>
                                	<option value="html" <?php echo ($weeverapp->theme->titlebarSource == 'html' ? "selected='selected'":""); ?>><?php echo __( 'Use Custom HTML (in advanced theme settings)', 'weever' ); ?></option>
                            	</select>
                        	</td>
                    	</tr>
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( 'This name is used across the top of your app if you choose a text-based titlebar. Also, if you enabled <b>Weever Ecosystem</b>, this name will be used for your listing.', 'weever' ); ?>"><?php echo __( 'Website Name' ); ?></td>
                        	<td><input type="text" name="titlebar_title" maxlength="35" style="width:250px;" value="<?php echo htmlentities($weeverapp->titlebar_title, ENT_QUOTES, "UTF-8"); ?>" class="required" /></td>
                    	</tr>
                    	<tr>
                        	<td class="key hasTip" title="<?php echo __( "This name is used for visitors who <b>install</b> your app to their homescreen, and appears underneath the app's icon.", 'weever' ); ?>"><?php echo __( 'App Installation Name' ); ?></td>
                        	<td><input type="text" name="title" maxlength="10" style="width:90px;" value="<?php echo htmlentities($weeverapp->title, ENT_QUOTES, "UTF-8"); ?>" class="required" /></td>
                    	</tr>
                	</table>
                	</fieldset>
                </div>


            	<div>
            		<fieldset>
                		<legend><?php echo __( 'Launch Screens, App Install Icon and Logo', 'weever' ); ?></legend>
                		<br />
                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'Tablet Portrait<br />(1536 x 2008 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="tablet_load_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->tablet_load_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 920}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->tablet_load_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>


                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'Tablet Landscape<br />(1496 x 2048 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="tablet_landscape_load_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->tablet_landscape_load_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 920}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->tablet_landscape_load_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'Phone Launch Screen<br />(640 x 920 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="phone_load_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->phone_load_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 640}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->phone_load_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'App Installation Icon<br/>(144 x 144 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="icon_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->icon_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 144, y: 144}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->icon_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

                		<div class="wx-theme-screen">

                    		<div>
                        		<div class="wx-theme-caption"><?php echo __( 'App Logo Image<br/>(600 x 64 pixel PNG)', 'weever' ); ?></div>
                                        <input type="file" class="wx-theme-input" name="titlebar_logo_live" size="13" />
                        		<a href='<?php echo $weeverapp->theme->titlebar_logo_live; ?>?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 600, y: 64}}'>
                        		<img class="wx-theme-image" src="<?php echo $weeverapp->theme->titlebar_logo_live; ?>?nocache=<?php echo microtime(); ?>" />
                        		</a>
                    		</div>

                		</div>

            		</fieldset>
        		</div>



        	</div>
        	<div id="tabs-2">
				<div>
            		<fieldset>
                		<legend><?php echo __( 'CSS Template Overrides' ); ?></legend>

                		<div>
                			<input type="checkbox" class="wx-check" value="1" id="wx-template-overrides" name="useCssOverride" <?php echo ($weeverapp->theme->useCssOverride == '1' ? "checked='checked'":""); ?> /><label for="wx-template-overrides" class="wx-check-label"><?php echo __( 'Use CSS Template Overrides' ); ?></label>
                		</div>

                		<p><?php echo __( 'Enter CSS Classes in the appropriate text boxes below.', 'weever' ); ?></p>

                		<table class="admintable">
                    		<tr>
                        		<td class="key">&lt;a&gt; <?php echo __( '<a> Links', 'weever' ); ?></td>
                        		<td>
                        		<textarea name="aLink"><?php echo $weeverapp->theme->aLink; ?></textarea>
                        		</td>
                    		</tr>

                    		<tr>
                    			<td class="key"><?php echo __( 'Title Bar <span>', 'weever' ); ?> &lt;span&gt;</td>
                        		<td>
                        		<textarea name="spanLogo"><?php echo $weeverapp->theme->spanLogo; ?></textarea>
                        		</td>
                    		</tr>

                    		<tr>
                        		<td class="key"><?php echo __( 'Buttons', 'weever' ); ?></td>
                        		<td>
                        		<textarea name="contentButton"><?php echo $weeverapp->theme->contentButton; ?></textarea>
                        		</td>
                    		</tr>

                    		<tr>
                        		<td class="key"><?php echo __( 'Borders', 'weever' ); ?></td>
                        		<td>
                        		<textarea name="border"><?php echo $weeverapp->theme->border; ?></textarea>
                        		</td>
                    		</tr>
                		</table>
            		</fieldset>

                	<fieldset>
                    	<legend><?php echo __( 'Title Bar Custom HTML', 'weever' ); ?></legend>

                    	<?php echo __( 'For Advanced Users only. Custom HTML override for Title Bar (logo) area.' ); ?><br /><?php echo __( 'Warning: Use of Javascript in this area may disable the web app.' ); ?>
                    	<table class="admintable">
                        	<tr>
                            	<td class="key"><?php echo __( 'Custom HTML', 'weever' ); ?></td>
                            	<td><textarea name="titlebarHtml" rows="7" cols="50"><? echo htmlspecialchars( $weeverapp->theme->titlebarHtml ); ?></textarea></td>
                        	</tr>
                    	</table>
            		</fieldset>
            	</div>

        	</div>
        </div>

    </form>
</div>
