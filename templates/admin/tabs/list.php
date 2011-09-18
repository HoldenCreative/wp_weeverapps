<?php
/*
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*				Modified by Brian Hogg (brian@bhconsulting.ca)
*	Version: 	0.9.2
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/

//$option = JRequest::getCmd('option');
//JHTML::_('behavior.tooltip');

require( trailingslashit( dirname( __FILE__ ) ) . '../parts/list_base64images.php' );

$child_html = "";
$k = 0; // for alternating shaded rows
$iii = 0; // for making checkboxes line up right
$tabsUnpublished = 0;
$onlineSpan = "";
$offlineSpan = "";

if ($weeverapp->appEnabled) {
	$offlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "";
} else {
	$onlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
}

?>

<div id="wx-app-status-button" <?php echo $offlineStatusClass; ?>><img id="wx-app-status-img" src="../media/com_weever/icon_live.png?nocache=<?php echo microtime(); ?>" /><br /><span id="wx-app-status-online" <?php echo $onlineSpan; ?>><?php echo __('WEEVER_ONLINE'); ?></span><span id="wx-app-status-offline" <?php echo $offlineSpan; ?>><?php echo __('WEEVER_OFFLINE'); ?></span></div>

<div id="listTabs">
	<ul id="listTabsSortable" style="padding-right: 50%">

        <?php

        for ($i = 0, $n = count( $weeverapp->tabRows ); $i < $n; $i++ )
        {
        	$row = &$weeverapp->tabRows[$i];
        	$componentRowsName = $row->component . 'Rows';
        	$componentRows = $weeverapp->{$componentRowsName};
        	$tabActive = false;

        	for ( $ii = 0, $nn = count( $componentRows ); $ii < $nn; $ii++ )
        	{

        		$subrow = &$componentRows[$ii];

        		if ( $subrow->published )
        		{
        			$tabActive = true;
        			break;
        		}
        	}

        	$componentRowsCount = count($componentRows);
        	$tabIcon = $row->component . "Icon";

        	if ( ! $componentRowsCount || ! $tabActive )
        		echo '<li id="' . $row->component . 'TabID" class="wx-nav-tabs" rel="unpublished" style="float:right;" style="float:center;"><a href="#'. $row->component . 'Tab" class="wx-tab-sortable"><div class="'.$row->icon.' wx-grayed-out wx-nav-icon" rel="'.$weeverapp->site_key.'" style="height:32px;width:auto;min-width:32px;text-align:center" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.$weeverapp->theme->{$tabIcon}.'" /></div><div class="wx-nav-label wx-grayed-out" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';
        	else
        		echo '<li id="' . $row->component . 'TabID" class="wx-nav-tabs" ><a href="#'. $row->component . 'Tab" class="wx-tab-sortable"><div class="'.$row->icon.' wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" rel="'.$weeverapp->site_key.'" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.$weeverapp->theme->{$tabIcon}.'" /></div><div class="wx-nav-label" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';
        }

         ?>

	</ul>

    <div id="wx-overlay-drag"><div id="wx-overlay-unpublished"><?php echo __('WEEVER_ICON_HAS_NO_PUB_ITEMS'); ?></div><img id="wx-overlay-drag-img" src="components/com_weever/assets/icons/drag.png" /><div><?php echo __('WEEVER_DOUBLE_CLICK_EDIT'); ?></div></div>

    <div id='wx-modal-loading'>
        <div id='wx-modal-loading-text'></div>
        <div id='wx-modal-secondary-text'></div>
        <div id='wx-modal-error-text'></div>
    </div>

    <form action='' method='post' name='adminForm' id='adminForm'>

    <?php

    for ( $i = 0, $n = count( $weeverapp->tabRows ); $i < $n; $i++ ) {
    	$row = &$weeverapp->tabRows[$i];

    	$link = JFilterOutput::ampReplace('index.php?option=' . $option . '&task=edit&layout=tab&cid[]='.$row->id);

    	$componentRowsName = $row->component . 'Rows';
    	$componentRows = $weeverapp->{$componentRowsName};

    	switch ( $row->component ) {
    		case "blog":
    			$componentName = __('WEEVER_TYPE_BLOG');
    			$componentHelp = __('WEEVER_LIST_BLOG_HELP');
    			break;
    		case "page":
    			$componentName = __('WEEVER_TYPE_ARTICLE');
    			$componentHelp = __('WEEVER_LIST_ARTICLE_HELP');
    			break;
    		case "contact":
    			$componentName = __('WEEVER_TYPE_CONTACT');
    			$componentHelp = __('WEEVER_LIST_CONTACT_HELP');
    			break;
    		case "component":
    			$componentName = __('WEEVER_TYPE_COMPONENT');
    			$componentHelp = __('WEEVER_LIST_COMPONENT_HELP');
    			break;
    		case "listingcomponent":
    			$componentName = __('WEEVER_TYPE_COMPONENT_LIST');
    			$componentHelp = __('WEEVER_LIST_COMPONENT_LIST_HELP');
    			break;
    		case "video":
    			$componentName = __('WEEVER_TYPE_VIDEO_FEED');
    			$componentHelp = __('WEEVER_LIST_VIDEO_HELP');
    			break;
    		case "social":
    			$componentName = __('WEEVER_TYPE_SOCIAL_NETWORK');
    			$componentHelp = __('WEEVER_LIST_SOCIAL_NETWORK_HELP');
    			break;
    		case "photo":
    			$componentName = __('WEEVER_TYPE_PHOTO_FEED');
    			$componentHelp = __('WEEVER_LIST_PHOTO_FEED_HELP');
    			break;
    	}

    	if ( count( $componentRows ) ) {
    		$published = JHTML::_('grid.published', $row, $iii);
    		$checked = JHTML::_('grid.id', $iii, $row->id);

    		if ( $row->published == 0 )
    			$tabsUnpublished++;
    	} else {
    		$published = __('WEEVER_NOT_APPLICABLE');
    		$checked = null;
    		$tabsUnpublished++;
    	}

    	?>


    	<div id="<?php echo $row->component . 'Tab' ?>">

    	<?php echo 'TEMPLATE'; //echo $weeverapp->loadTemplate($row->component.'dropdown'); ?>

    	<input type="hidden" name="boxchecked<?php echo $row->component; ?>" id="boxchecked<?php echo $row->component; ?>" value="0" />
    	<table class='adminlist'>
    	<thead>
    	<tr>
    	<th width='20'>
    		<input type='checkbox' name='toggle<?php echo $row->component; ?>' id='toggle<?php echo $row->component; ?>' value='' onclick='checkAllTab(<?php echo count($componentRows); ?>, "cb", document.getElementById("boxchecked<?php echo $row->component; ?>"), document.getElementById("toggle<?php echo $row->component; ?>"), <?php echo $iii; ?> + 1);' />
    	</th>

    	<th class='title'><?php echo __( 'NAME' ); ?></th>
    	<th width='8%' nowrap='nowrap'><?php echo __( 'PUBLISHED' ); ?></th>
    	<th width='8%' nowrap='nowrap'><?php echo __( 'ORDER' ); ?></th>
    	<th width='5%' nowrap='nowrap'><?php echo __( 'ID' ); ?></th>
    	<th width='8%' nowrap='nowrap'><?php echo __( 'Delete' ); ?></th>
    	</tr>
    	</thead>

    	<?php

    	$k = 1 - $k;
    	$sub = 0;

    	for ( $ii = 0, $nn = count( $componentRows ); $ii < $nn; $ii++ ) {

    		$iii++; $sub++;
    		$row = &$componentRows[$ii];

    		?>

    		<tr class='<?php echo "row$k"; ?>'>
        		<td>
        			<input type="checkbox" id="cb<?php echo $iii; ?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" title="Checkbox for row <?php echo $row->id; ?>">
        			<?php //echo JHTML::_('grid.id', $iii, $row->id); ?>
        		</td>

        		<td>
        			<a href='#' title="ID #<?php echo $row->id; ?>" class="wx-subtab-link"><?php echo $row->name; ?></a>
        		</td>
        		<td align='center'>
        			 <a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-publish"<?php echo ($row->published ? 'rel="1"><img src="components/com_weever/assets/icons/tick.png" border="0" alt="Published">' : 'rel="0"><img src="components/com_weever/assets/icons/publish_x.png" border="0" alt="Unpublished">'); ?></a>
        		</td>
        		<td align="center">
        			<a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-down" rel="<?php echo $row->type; ?>"><img src="components/com_weever/assets/icons/downarrow.png" width="16" height="16" border="0" alt="Move Down"></a>
        			<a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-up" rel="<?php echo $row->type; ?>"><img src="components/com_weever/assets/icons/uparrow.png" width="16" height="16" border="0" alt="Move Up"></a>
        			(<?php echo floor($row->ordering); ?>)
        		</td>
        		<td align='center'>
        			<?php echo $row->id; ?>
        		</td>
        		<td align='center'><a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-delete" rel="<?php echo $row->type; ?>" title="<?php echo __( 'Delete' ); ?> &quot;<?php echo htmlentities($row->name); ?>&quot;"><img src="components/com_weever/assets/icons/wx-delete-mark.png" /></a></td>
    		</tr>

    		<?php
    		$k = 1 - $k;

    	}

    	if ( ! count( $componentRows ) ) {
    		echo "<tr><td colspan='6'>".__('WEEVER_NO_ITEMS_IN_TAB')."</td></tr>";
    	}

    	?>

    	</table>
    	</div>

    	<?php

    }

    ?>

        <input type="hidden" name="option" value="<?php //echo $option; ?>" />
        <input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $weeverapp->site_key; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="view" value="list" />
        <input type="hidden" name="filter_order" value="<?php //echo $weeverapp->lists['order']; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php //echo $weeverapp->lists['order_Dir']; ?>" />
    </form>
</div>

