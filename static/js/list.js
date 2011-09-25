/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.3
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

jQuery(function() {
	jQuery("#listTabs").tabs( {
		
		select: function(e, ui) {

			var t = String(ui.tab);
			var tpos = strpos(t, '#');
			t = t.substring(tpos + 1);
			tpos = strpos(t, 'Tab');
			t = t.substring(0, tpos);
			
			jQuery('.wx-title').attr('name','noname');
			jQuery('#wx-'+t+'-title').attr('name', 'name');
			jQuery('#wx-select-'+t).val(0).change();
			jQuery('.wx-title').attr('name','noname');
			jQuery('.wx-reveal').hide();
			jQuery('.wx-dummy').hide();
			jQuery('.wx-'+t+'-dummy').show();
		
		}
	
	});

	jQuery("#listTabsSortable").sortable({ 
										axis: "x",
										update: function(event, info) {
															
											var str = String(jQuery(this).sortable('toArray'));
											var siteKey = jQuery("input#wx-site-key").val();
											
											jQuery.ajax({
											   type: "POST",
											   url: ajaxurl,
											   data: "option=com_weever&task=ajaxSaveTabOrder&site_key="+siteKey+"&order="+str,
											   success: function(msg){
											     jQuery('#wx-modal-loading-text').html(msg);
											     
											     if(msg == "Order Updated")
											     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
											     else
											     {
											     	jQuery('#wx-modal-secondary-text').html('');
											     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
											     }
											   }
											 });
															
										}
																					 	
									});

});

jQuery(document).ready(function(){ 

	//
	
	jQuery("#wx-app-status-button").click(function(e) {
	
		var siteKey = jQuery("input#wx-site-key").val();
	
		if( jQuery("#wx-app-status-online").hasClass("wx-app-hide-status") ) {
			
			
			jQuery.ajax({
			   type: "POST",
			   url: ajaxurl,
				   data: "option=com_weever&task=ajaxToggleAppStatus&app_enabled=1&site_key="+siteKey,
			   success: function(msg){
			   
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     if(msg == "App Online")
			     {
			     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_ONLINE);
			     	jQuery("#wx-app-status-online").removeClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-offline").addClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-button").removeClass("wx-app-status-button-offline");
			     }
			     else
			     {
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
			     }
	
			   }
			 });
			
			
		}
		else {
	
			jQuery.ajax({
			   type: "POST",
			   url: ajaxurl,
			   data: "option=com_weever&task=ajaxToggleAppStatus&app_enabled=0&site_key="+siteKey,
			   success: function(msg){
			   
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     if(msg == "App Offline")
			     {
			     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_OFFLINE);
			     	jQuery("#wx-app-status-online").addClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-offline").removeClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-button").addClass("wx-app-status-button-offline");
			     }
			     else
			     {
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
			     }
	
			   }
			 });
	
	
		}
	
	});
	
	
	
	jQuery("li.wx-nav-tabs").bind("mouseover", function(){
	
		
		
		if(jQuery(this).attr("rel") == "unpublished")
		{
			jQuery("#wx-overlay-drag-img").hide();
			jQuery("#wx-overlay-unpublished").show();
		}
		
		jQuery("#wx-overlay-drag").show();
		
		
	
	});
	
	jQuery("li.wx-nav-tabs").bind("mouseout", function(){
	
		jQuery("#wx-overlay-drag").hide();
		jQuery("#wx-overlay-unpublished").hide();
		jQuery("#wx-overlay-drag-img").show();
	
	});
	
	jQuery('#wx-modal-loading')
	    .hide()  
	    .ajaxStart(function() {
	    	jQuery('#wx-modal-error-text').html('');
	        jQuery(this).fadeIn(200);
	        jQuery('#wx-modal-loading-text').html(WPText.WEEVER_JS_SAVING_CHANGES);
	        jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_PLEASE_WAIT);
	    })
	    .ajaxStop(function() {
	    	var jObj = jQuery(this);
	    	setTimeout( function() {
	    			jObj.fadeOut(750);
	    		}, 600 );
	    });
	
	
	jQuery('div.wx-nav-icon').dblclick(function(){
	
		var tabType = jQuery(this).attr('title');
		var siteKey = jQuery("input#wx-site-key").val();
		var nonce = jQuery("input#nonce").val();		
		var txt = 	'<div class="jqimessage">'+
			'<h3 class="wx-imp-h3">'+WPText.WEEVER_JS_CHANGING_NAV_ICONS+'</h3>'+
			WPText.WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS_A+'<p>'+
			WPText.WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS_B+' <a href="http://cartanova.ca/images/blog-icon.png" target="_blank">Example</a>'+'</p>'+
			'<div id="wx-nav-icon-preview-wrapper">'+
			'<img id="wx-nav-icon-preview" src="">'+
			'<img src="'+WPText.WEEVER_JS_NO_IMAGE_URL+'">'+
			'</div>'+
			'<div id="wx-nav-icon-textarea-wrapper">'+
			'<textarea name="nav_icon" id="wx-nav-icon-textarea" placeholder="'+WPText.WEEVER_JS_CHANGING_NAV_PASTE_CODE+'"></textarea>'+
			'<br/><br/></div></div>';
		
		// Replace the i18n placeholders.  For some reason html code is escaped instead of being left alone with the WPText function.
		txt = txt.replace('%1', '<a href="http://www.opinionatedgeek.com/dotnet/tools/base64encode/" target="_blank">').replace('%2', '</a>');

		var clickedElem = jQuery(this);
		
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true)
			{ 
			
				tabIcon = f["nav_icon"];
				
				jQuery.ajax({
				   type: "POST",
				   url: ajaxurl,
				   data: {
					   action: 'ajaxSaveTabIcon',
					   icon: tabIcon,
					   type: tabType,
					   nonce: nonce
				   },
				   success: function(msg){
					   jQuery('#wx-modal-loading-text').html(msg);

					   jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
  			     		clickedElem.html('<img class="wx-nav-icon-img" src="data:image/png;base64,'+tabIcon+'" />');
				   },
				   error: function(v,msg){
					   jQuery('#wx-modal-loading-text').html(msg);
				    
				     	jQuery('#wx-modal-secondary-text').html('');
				     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				   }
				 });
			
			}
			
			
		}	
		
		submitCheck = function(v,m,f){
			
			an = m.children('#wx-nav-icon-textarea');
			
			if(v == "reset")
			{ 
				jQuery("textarea#wx-nav-icon-textarea").val(iconDefault[tabType]);
				setTimeout('previewIcon();', 10);
				return false;
			}
			
		
			if(f.nav_icon == "" && v == true){
				an.css("border","solid #ff0000 1px");
				return false;
			}
			
			return true;
		
		}	
		
		previewIcon = function() {
		
			jQuery("img#wx-nav-icon-preview").attr(
				"src", 
				"data:image/png;base64," + 
					jQuery("textarea#wx-nav-icon-textarea").val()
				);
				
		}
		
				
		var tabIcon = jQuery.prompt(txt, {
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, "Reset to Default": "reset", Submit: true },
				focus: 2
				});	
				
		jQuery("textarea#wx-nav-icon-textarea").bind("paste", function(){
			
			setTimeout('previewIcon();', 10);
			
		});
		
	});
	
	
	jQuery('div.wx-nav-label').dblclick(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var htmlName = jQuery(this).html();
		var nonce = jQuery("input#nonce").val();
		var txt = 	'<h3 class="wx-imp-h3">'+WPText.WEEVER_JS_ENTER_NEW_APP_ICON_NAME+'</h3>'+
					'<input type="text" id="alertName" name="alertName" value="'+htmlName+'" />';
		var clickedElem = jQuery(this);
					
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true)
			{ 
			
				tabName = f["alertName"];
				
				jQuery.ajax({
				   type: "POST",
				   url: ajaxurl,
				   data: {
					   name: tabName,
					   id: tabId,
					   nonce: nonce,
					   action: 'ajaxSaveTabName'
				   },
				   success: function(msg){

					    jQuery('#wx-modal-loading-text').html(msg);
				     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				     	clickedElem.html(tabName);
				     },
				   error: function(v,msg){
					     jQuery('#wx-modal-loading-text').html(msg);
					   
				     	jQuery('#wx-modal-secondary-text').html('');
				     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				     }
				 });
			
			}
		};	
		
		submitCheck = function(v,m,f){
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true){
				an.css("border","solid #ff0000 1px");
				return false;
			}
			
			return true;
		
		};		
		
		var tabName = jQuery.prompt(txt, {
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, Submit: true },
				focus: 1
				});
				
		jQuery('input#alertName').select();
		// hit 'enter/return' to save
		jQuery("input#alertName").bind("keypress", function (e) {
		        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		            jQuery('button#jqi_state0_buttonSubmit').click();
		            return false;
		        } else {
		            return true;
		        }
		    });

	});
	


	jQuery('a.wx-subtab-link').click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var htmlName = jQuery(this).html();
		var txt = 	'<h3 class="wx-imp-h3">'+WPText.WEEVER_JS_ENTER_NEW_APP_ITEM+'</h3>'+
					'<input type="text" id="alertName" name="alertName" value="'+htmlName+'" />';
		var clickedElem = jQuery(this);
		var nonce = jQuery("input#nonce").val();		
					
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true)
			{ 
			
				tabName = f["alertName"];
				
				jQuery.ajax({
				   type: "POST",
				   url: ajaxurl,
				   data: {
					   name: tabName,
					   id: tabId,
					   nonce: nonce,
					   action: 'ajaxSaveTabName'					   
				   },
				   success: function(msg){

					    jQuery('#wx-modal-loading-text').html(msg);
				     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				     	clickedElem.html(tabName);
				     },
				   error: function(v,msg){
					    jQuery('#wx-modal-loading-text').html(msg);
				     	jQuery('#wx-modal-secondary-text').html('');
				     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				     }
				 });
			
			}
		}	
		
		submitCheck = function(v,m,f){
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true){
				an.css("border","solid #ff0000 1px");
				return false;
			}
			
			return true;
		
		}		
		
		var tabName = jQuery.prompt(txt, {
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, Submit: true },
				focus: 1
				});
				
		jQuery('input#alertName').select();
		// hit 'enter/return' to save
		jQuery("input#alertName").bind("keypress", function (e) {
		        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		            jQuery('button#jqi_state0_buttonSubmit').click();
		            return false;
		        } else {
		            return true;
		        }
		    });

	});
	
	jQuery("a.wx-subtab-publish").click(function() {
	
		var nonce = jQuery("input#nonce").val();		
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var clickedElem = jQuery(this);
		var pubStatus = jQuery(this).attr('rel');
		var unpublishedIcon = '<img src="'+WPText.WEEVER_JS_STATIC_PATH+'images/icons/publish_x.png" border="0" alt="Unpublished">';
		var publishedIcon = '<img src="'+WPText.WEEVER_JS_STATIC_PATH+'images/icons/tick.png" border="0" alt="Published">';
		
		jQuery.ajax({
		   type: "POST",
		   url: ajaxurl,
		   data: {
			   action: 'ajaxTabPublish',
			   status: pubStatus,
			   id: tabId,
			   nonce: nonce
		   },
		   success: function(msg){
		     jQuery('#wx-modal-loading-text').html(msg);
		     
	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
	     	
	     	if(pubStatus == 1)
	     	{
	     		clickedElem.html(unpublishedIcon);
	     		clickedElem.attr('rel', 0);
	     	}
	     	else
	     	{
	     		clickedElem.html(publishedIcon);
	     		clickedElem.attr('rel', 1);
	     	}
		   },
		   error: function(v,msg){
			     jQuery('#wx-modal-loading-text').html(msg);
		   
		     	jQuery('#wx-modal-secondary-text').html('');
		     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
		   }
		 });
	
	});
	
		jQuery("a.wx-subtab-delete").click(function() {
		
			var tabId = jQuery(this).attr('title');
			tabId = tabId.substring(4);
			var siteKey = jQuery("input#wx-site-key").val();
			var nonce = jQuery("input#nonce").val();
			var tabType = jQuery(this).attr('rel');
			var tabName = jQuery(this).attr('alt');
			var deleteButton = this;
			var confDelete = confirm(WPText.WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO+tabName+WPText.WEEVER_JS_QUESTION_MARK);
			
			if(!confDelete)
				return false;
			
			jQuery.ajax({
			   type: "POST",
			   url: ajaxurl,
			   data: { 
				   id: tabId, 
				   nonce: nonce, 
				   action: 'ajaxSubtabDelete' 
			   },
			   success: function(msg){
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
			     	// Delete the table row this delete image is in
			     	console.debug(deleteButton);
			     	jQuery(deleteButton).parent("td:first").parent("tr:first").remove();
		     		//document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+'#'+tabType+'Tab';
		     		//setTimeout("document.location.reload(true);",20);
			   },
			   error: function(v,msg){
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
			   }
			 });
		
		});
	
	
	jQuery("a.wx-subtab-up").click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var tabType = jQuery(this).attr('rel');
	
		jQuery.ajax({
		   type: "POST",
		   url: ajaxurl,
		   data: "option=com_weever&task=ajaxSaveSubtabOrder&site_key="+siteKey+"&type="+tabType+"&dir=up&id="+tabId,
		   success: function(msg){
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     if(msg == "Order Updated")
		     {
		     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
		     	document.location.href = "index.php?option=com_weever#"+tabType+"Tab";
		     	setTimeout("document.location.reload(true);",20);
		     }
		     else
		     {
		     	jQuery('#wx-modal-secondary-text').html('');
		     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
		     }
		   }
		 });
	
	});
	
	jQuery("a.wx-subtab-down").click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var tabType = jQuery(this).attr('rel');
	
		jQuery.ajax({
		   type: "POST",
		   url: ajaxurl,
		   data: "option=com_weever&task=ajaxSaveSubtabOrder&site_key="+siteKey+"&dir=down&type="+tabType+"&id="+tabId,
		   success: function(msg){
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     if(msg == "Order Updated")
		     {
		     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
		     	document.location.href = "index.php?option=com_weever#"+tabType+"Tab";
		     	setTimeout("document.location.reload(true);",20);
		     }
		     else
		     {
		     	jQuery('#wx-modal-secondary-text').html('');
		     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
		     }
		   }
		 });
	
	});

});