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

jQuery(document).ready(function(){ 

	jQuery('input#wx-contact-submit').click(function(e) {
	  
  	  	// Validation
  	  	jQuery('#contactAdminForm').validate({ 
  	  		rules: {
  	  			name: { required: true },
  	  			component_id: { required: true },
  	  			"wx-select-contact": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

				var componentId = jQuery("select[name=component_id]").val();
				var tabName = jQuery('input#wx-contact-title').val();
				var siteKey = jQuery("input#wx-site-key").val();
				var nonce = jQuery("input#nonce").val();
				
				var emailForm;
				
				if(jQuery("input[name=emailform]").is(":checked"))
					emailForm = jQuery("input[name=emailform]").val();
				else
					emailForm = 0;
					
				var googleMaps;
				
				if(jQuery("input[name=googlemaps]").is(":checked"))
					googleMaps = jQuery("input[name=googlemaps]").val();
				else
					googleMaps = 0;
				
				jQuery.ajax({
				 type: "POST",
				 url: ajaxurl,
				 data: {
					 action: 'ajaxSaveNewTab',
					 name: tabName,
					 type: 'contact',
					 emailform: emailForm,
					 googlemaps: googleMaps,
					 component: 'contact',
					 component_id: componentId,
					 published: 1,
					 nonce: nonce
				 },
			  	   success: function(msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  	     
				  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#contactTab";
				  	     	document.location.reload(true);
				  	   },
				  	   error: function(v,msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  		   
				  	     	jQuery('#wx-modal-secondary-text').html('');
				  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				  	   }
				});
  	  		}
  	  	});
	});
	
	jQuery('input#wx-page-submit').click(function(e) {
  
  	  	jQuery('#pageAdminForm').validate({ 
  	  		rules: {
  	  	  		cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-page": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
	  	  	
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

			  	var cmsFeed = jQuery("select[name=cms_feed]").val();
			  	var tabName = jQuery('input#wx-page-title').val();
			  	var siteKey = jQuery("input#wx-site-key").val();
				var nonce = jQuery("input#nonce").val();
			  	
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'page',
			  		   component: 'page',
			  		   component_behaviour: 'leaf',
			  		   published: '1',
			  		   cms_feed: cmsFeed,
			  		   nonce: nonce
			  	   },
  		  	  	   success: function(msg){
    		  	  	     jQuery('#wx-modal-loading-text').html(msg);

    		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
    		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#pageTab";
    		  	  	     	document.location.reload(true);
    		  	  	   },
    		  	  	   error: function(v,msg){
     		  	  	     jQuery('#wx-modal-loading-text').html(msg);
    		  	  	     	jQuery('#wx-modal-secondary-text').html('');
    		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
    		  	  	   }
			  	 });
  	  		}
  	  	});
	});
	
	jQuery('input#wx-blog-submit').click(function(e) {

  	  	// Validation
  	  	jQuery('#blogAdminForm').validate({ 
  	  		rules: {
  	  	  		s: { required: true },
  	  			cms_feed: { required: true },
  	  			name: { required: true },
  	  			"wx-select-blog": { required: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
  	  			
  	  			var optionVal = jQuery('#wx-select-blog').val();
  	    		var cmsFeed = jQuery("select[name=cms_feed]").val();
  	    	  	var tabName = jQuery('input#wx-blog-title').val();
  	    	  	var tabSearchTerm = jQuery('input[name=s]').val();
  	    	  	var siteKey = jQuery("input#wx-site-key").val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	    	  	
  	  			if (optionVal == 's') {
  	  				// Search feed
  	  				cmsFeed = 'index.php?s='+encodeURIComponent(tabSearchTerm)+'&feed=r3s';
  	  			}
  	  			
  		  	  	jQuery.ajax({
  		  	  	   type: "POST",
  		  	  	   url: ajaxurl,
  		  	  	   data: {
  		  	  		   action: 'ajaxSaveNewTab',
  		  	  		   type: 'blog',
  		  	  		   component: 'blog',
  		  	  		   weever_action: 'add',
  		  	  		   published: '1',
  		  	  		   cms_feed: cmsFeed,
  		  	  		   name: tabName,
  		  	  		   nonce: nonce
  		  	  	   },
  		  	  	   success: function(msg){
  		  	  	     jQuery('#wx-modal-loading-text').html(msg);

  		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
  		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#blogTab";
  		  	  	     	document.location.reload(true);
  		  	  	   },
  		  	  	   error: function(v,msg){
   		  	  	     jQuery('#wx-modal-loading-text').html(msg);
  		  	  	     	jQuery('#wx-modal-secondary-text').html('');
  		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
  		  	  	   }
  		  	  	 });
  	  		}
  	  	});
	});
	
	jQuery('input#wx-video-submit').click(function(e) {
	  
  	  	jQuery('#videoAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			component_behaviour: { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
								
		 		var tabUrl = jQuery('#wx-video-url').val();
		  	  	var tabName = jQuery('input#wx-video-title').val();
		  	  	var siteKey = jQuery("input#wx-site-key").val();
		  	  	var component = jQuery("select#wx-select-video").val();
		  	  	var nonce = jQuery("input#nonce").val();
		  
		  	  	jQuery.ajax({
		  	  	   type: "POST",
		  	  	   url: ajaxurl,
		  	  	   data: {
		  	  		   action: 'ajaxSaveNewTab',
		  	  		   name: tabName,
		  	  		   type: 'video',
		  	  		   published: '1',
		  	  		   component: component,
		  	  		   component_behaviour: tabUrl,
		  	  		   nonce: nonce
		  	  	   },
  		  	  	   success: function(msg){
    		  	  	     jQuery('#wx-modal-loading-text').html(msg);

    		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
    		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#videoTab";
    		  	  	     	document.location.reload(true);
    		  	  	   },
    		  	  	   error: function(v,msg){
     		  	  	     jQuery('#wx-modal-loading-text').html(msg);
    		  	  	     	jQuery('#wx-modal-secondary-text').html('');
    		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
    		  	  	   }
		  	  	 });
  	  		}
  	  	});
	});
	
	jQuery('input#wx-social-submit').click(function(e) {
	  
  	  	// Validation
  	  	jQuery.validator.addMethod('twitteruserrequired', function(value, element, isactive) {
  	  		return !isactive || (value.trim() != '@' && value.substr(0, 1) == '@');
  	  	}, "Please enter a valid value");
  	  	
  	  	jQuery.validator.addMethod('twitterhashtagrequired', function(value, element, isactive) {
  	  		return !isactive || (value.trim() != '#' && value.substr(0, 1) == '#');
  	  	}, "Please enter a valid value");
  	  	
  	  	jQuery('#socialAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			"component_behaviour": { required: true, twitteruserrequired: function(element) {
  	    	  		return (jQuery("select#wx-select-social").val() == 'twitteruser');
  	    	  	}, twitterhashtagrequired: function(element) {
  	    	  		return (jQuery("select#wx-select-social").val() == 'twitterhashtag');
  	    	  	} }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();

  	    		var query = jQuery('#wx-social-value').val();
  	    	  	var tabName = jQuery('input#wx-social-title').val();
  	    	  	var siteKey = jQuery("input#wx-site-key").val();
  	    	  	var component = jQuery("select#wx-select-social").val();
  	    	  	var nonce = jQuery("input#nonce").val();
  	  	
		  	  	jQuery.ajax({
		  	  	   type: "POST",
		  	  	   url: ajaxurl,
		  	  	   data: {
		  	  		   action: 'ajaxSaveNewTab',
		  	  		   name: tabName,
		  	  		   type: 'social',
		  	  		   published: 1,
		  	  		   component: component,
		  	  		   component_behaviour: query,
		  	  		   nonce: nonce
		  	  	   },
		  	  	   success: function(msg){
		  	  	     jQuery('#wx-modal-loading-text').html(msg);
		  	  	     
		  	  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
		  	  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#socialTab";
		  	  	     	document.location.reload(true);
		  	  	     },
		  	  	     error: function(v,msg){
		  	  	    	 jQuery('#wx-modal-loading-text').html(msg);
		  	  	     	jQuery('#wx-modal-secondary-text').html('');
		  	  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
		  	  	   }
		  	  	 });
  	  		}
  	  	});
	});
	
	jQuery('input#wx-photo-submit').click(function(e) {

  	  	jQuery('#photoAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			url: { required: true, url: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
  	  			e.preventDefault();
				
			  	var tabUrl = jQuery('#wx-photo-url').val();
			  	var tabName = jQuery('input#wx-photo-title').val();
			  	var siteKey = jQuery("input#wx-site-key").val();
			  	var component = jQuery("select#wx-select-photo").val();
  	    	  	var nonce = jQuery("input#nonce").val();
		
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
			  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'photo',
			  		   published: 1,
			  		   component: component,
			  		   component_behaviour: tabUrl,
			  		   nonce: nonce
			  	   },
			  	   success: function(msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  	     
				  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#photoTab";
				  	     	document.location.reload(true);
				  	   },
				  	   error: function(v,msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  		   
				  	     	jQuery('#wx-modal-secondary-text').html('');
				  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				  	   }
			  	 });
  	  		}
  	  	});
	  	
	});
	
	
	jQuery('input#wx-calendar-submit').click(function(e) {
	  
  	  	jQuery('#calendarAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			url: { required: true, url: true },
  	  			email: { required: true, email: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
			  	e.preventDefault();
			  	 
			  	var tabEmail = jQuery('#wx-google-calendar-email').val();
			  	var tabUrl = jQuery('#wx-facebook-calendar-url').val();
			  	var tabName = jQuery('input#wx-calendar-title').val();
			  	var siteKey = jQuery("input#wx-site-key").val();
			  	var timezone = jQuery("#wx-select-facebook-timezone-time").val();
			  	var component = jQuery("select#wx-select-calendar").val();
			  	var componentBehaviour = null;
			  	var nonce = jQuery("input#nonce").val();
			  	
			  	if(component == "google.calendar") {
			  		componentBehaviour = tabEmail;
			  	} else {
			  		componentBehaviour = tabUrl;
			  	}
			  	
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
			  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'calendar',
			  		   published: 1,
			  		   component: component,
			  		   component_behaviour: componentBehaviour,
			  		   'var': timezone,
			  		   nonce: nonce
			  	   },
			  	   success: function(msg){
			  	     jQuery('#wx-modal-loading-text').html(msg);
			  	     
			  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
			  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#calendarTab";
			  	     	document.location.reload(true);
			  	   },
			  	   error: function(v,msg){
			  	     jQuery('#wx-modal-loading-text').html(msg);
			  		   
			  	     	jQuery('#wx-modal-secondary-text').html('');
			  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
			  	   }
			  	 });
  	  		}
  	  	});

	});
	
	
	jQuery('input#wx-form-submit').click(function(e) {
		
  	  	jQuery('#formAdminForm').validate({ 
  	  		rules: {
  	  	  		component: { required: true },
  	  			name: { required: true },
  	  			url: { required: true, url: true },
  	  			api_key: { required: true },
  	  			email: { required: true, email: true }
  	  	  	},
  	  		ignore: ":hidden",
  	  		// Prevent the error label from appearing at all
  	  		errorPlacement: function(error, element) { },
  	  		
  	  		submitHandler: function(form) {
			  	e.preventDefault();
			  	 	  
			  	var tabUrl = jQuery('#wx-form-url').val();
			  	var APIKey = jQuery('#wx-form-api-key').val();
			  	var tabName = jQuery('input#wx-form-title').val();
			  	var siteKey = jQuery("input#wx-site-key").val();
			  	var component = jQuery("select#wx-select-form").val();
			  	var nonce = jQuery("input#nonce").val();
			  	
			  	jQuery.ajax({
			  	   type: "POST",
			  	   url: ajaxurl,
			  	   data: {
			  		   action: 'ajaxSaveNewTab',
			  		   name: tabName,
			  		   type: 'form',
			  		   published: 1,
			  		   component: component,
			  		   component_behaviour: tabUrl,
			  		   'var': APIKey,
			  		   nonce: nonce
			  	   },
			  	   success: function(msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  	     
				  	     	jQuery('#wx-modal-secondary-text').html(WPText.WEEVER_JS_APP_UPDATED);
				  	     	document.location.href = WPText.WEEVER_JS_ADMIN_LIST_URL+"#formTab";
				  	     	document.location.reload(true);
				  	   },
				  	   error: function(v,msg){
				  	     jQuery('#wx-modal-loading-text').html(msg);
				  		   
				  	     	jQuery('#wx-modal-secondary-text').html('');
				  	     	jQuery('#wx-modal-error-text').html(WPText.WEEVER_JS_SERVER_ERROR);
				  	   }
			  	 });
  	  		}
  	  	});

	});

});