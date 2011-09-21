<?php

    class WeeverAppThemeStyles {

    	public 		$aLink;
    	public 		$spanLogo;
    	public 		$contentButton;
    	public 		$border;
    	public 		$fontType;
    	public 		$blogIcon;
    	public 		$pagesIcon;
    	public 		$contactIcon;
    	public 		$socialIcon;
    	public 		$videoIcon;
    	public 		$photoIcon;
    	public 		$mapIcon;
    	public 		$titlebarHtml;
    	public 		$titlebarSource		= "text";
    	public 		$template			= "sencha";
    	public 		$useCssOverride;
    	public 		$useCustomIcons;

    	// Theme images
    	public      $tablet_load_live;
    	public      $tablet_landscape_load_live;
    	public      $phone_load_live;
    	public      $icon_live;
    	public      $titlebar_logo_live;

    	public function __construct() {
    	    // TODO: Remove this and load from the server instead (pass in the CMS of 'Wordpress' to get the WP defaults if there are none saved yet)
    	    $this->tablet_load_live = get_option( 'weever_tablet_load_live', WEEVER_PLUGIN_URL . 'static/images/tablet_load_default.png' );
    	    $this->tablet_landscape_load_live = get_option( 'weever_tablet_landscape_load_live', WEEVER_PLUGIN_URL . 'static/images/tablet_landscape_load_default.png' );
    	    $this->phone_load_live = get_option( 'weever_phone_load_live', WEEVER_PLUGIN_URL . 'static/images/phone_load_default.png' );
    	    $this->icon_live = get_option( 'weever_icon_live', WEEVER_PLUGIN_URL . 'static/images/icon_default.png' );
    	    $this->titlebar_logo_live = get_option( 'weever_titlebar_logo_live', WEEVER_PLUGIN_URL . 'static/images/titlebar_logo_default.png' );
    	}

    	/**
    	 * Function to save the theme settings
    	 */
    	public function save() {
            // Save the options to the local db
            update_option( 'weever_tablet_load_live', $this->tablet_load_live );
            update_option( 'weever_tablet_landscape_load_live', $this->tablet_landscape_load_live );
            update_option( 'weever_phone_load_live', $this->phone_load_live );
            update_option( 'weever_icon_live', $this->icon_live );
            update_option( 'weever_titlebar_logo_live', $this->titlebar_logo_live );

    	    // TODO: Push to weever server
    	}

    }