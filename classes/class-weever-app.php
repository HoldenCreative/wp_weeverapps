<?php

class WeeverApp {

    private $_data = array();
    private $_device_options = array(
            // Granular options
            'DetectIphoneOrIpod' => 0,
            'DetectAndroid' => 0,
            'DetectBlackBerryTouch' => 0,
            'DetectWebOSTablet' => 0,
            'DetectIpad' => 0,
            'DetectBlackBerryTablet' => 0,
            'DetectAndroidTablet' => 0,
            'DetectGoogleTV' => 0,
            'DetectAppleTVTwo' => 0,
            'DetectTouchPad' => 0,
            // Options if granular is disabled
            'DetectTierWeeverSmartphones' => 1,
            'DetectTierWeeverTablets' => 0,
        );

    // TODO: Grab most of this data from the API
    /*
     * Constructor
     *
     * @return WeeverApp
     */
    public function __construct( $load_from_server = true ) {
        try {
            // Register the app with the helper class
            WeeverHelper::set_weeverapp($this);

            // Initial settings
            $this->_data['theme'] = new WeeverAppThemeStyles();
            $this->_data['app_enabled'] = 1; //get_option( 'weever_app_enabled', 0 );
            $this->_data['site_key'] = get_option( 'weever_api_key', '' );
            $this->_data['staging_mode'] = get_option( 'weever_staging_mode', 0 );
            $this->_data['primary_domain'] = '';
            $this->_data['titlebar_title'] = '';
            $this->_data['title'] = '';
            $this->_data['google_analytics'] = '';
            $this->_data['ecosystem'] = '';
            $this->_data['domain'] = '';

            $this->_data['tabs'] = array();

            // QR code urls
            $this->_data['qr_code_private'] = $this->_data['qr_code_public'] = '';

            // Device detection settings
            $this->_data['granular'] = get_option( 'weever_granular_devices', 0 );
            foreach ( $this->_device_options as $key => $value ) {
                 $this->_data[$key] = get_option( 'weever_device_option_'.$key, $value );
            }

            // Stub of rows
            /*
            $blogtab = new WeeverAppTab(4, 'blog', 'Blogs', 1);
            $socialtab = new WeeverAppTab(3, 'social', 'Social', 1);

            $this->_data['tabs'] = array(new WeeverAppTab(1, 'contact', 'Contact', 1),
                                            new WeeverAppTab(2, 'page', 'Pages', 1),
                                            $socialtab,
                                            $blogtab,
                                            new WeeverAppTab(5, 'photo', 'Photos', 1),
                                            new WeeverAppTab(6, 'video', 'Videos', 1),
                                            new WeeverAppTab(12, 'calendar', 'Events', 1),
                                            new WeeverAppTab(105, 'form', 'Forms', 1),
                                            );

            $socialsubtab = new WeeverAppSubtab(8, 'Twitter tt', 'social', rand(1,10), 1);
            $socialtab->add_subtab($socialsubtab);
            $this->_data['tabs'][] = $socialsubtab;

            $blogsubtab = new WeeverAppSubtab(7, 'Parks Home', 'blog', rand(1,10), 1);
            $blogtab->add_subtab($blogsubtab);
            $this->_data['tabs'][] = $blogsubtab;

            $blogsubtab = new WeeverAppSubtab(15, 'Animals - Category', 'blog', rand(1,10), 1);
            $blogtab->add_subtab($blogsubtab);
            $this->_data['tabs'][] = $blogsubtab;*/

            if ( $load_from_server ) {
                $this->reload_from_server();
            }

            // Finished, mark as loaded
            $this->_data['loaded'] = true;
        } catch ( Exception $e ) {
            $this->_data['loaded'] = false;
        }
    }

    public function & __get($var) {

        switch ( $var ) {
            default:
                if ( array_key_exists( $var, $this->_data ) )
                    return $this->_data[$var];
                else
                    throw new Exception( "Invalid parameter name $var" );
        }

    }

    public function __set($var, $val) {

        switch ( $var ) {
            case 'staging_mode':
                if ( $val )
                    $this->_data['staging_mode'] = 1;
                else
                    $this->_data['staging_mode'] = 0;
                break;

            case 'site_key':
                // TODO: Add any pre-validation here
                $this->_data['site_key'] = $val;
                break;

            case 'primary_domain':
                throw new Exception( "Cannot set $var directly" );
                break;

            default:
                if ( array_key_exists( $var, $this->_data ) ) {
                    $this->_data[$var] = $val;
                } else {
                    throw new Exception( "Invalid parameter name $var" );
                }
        }

    }

    /**
     * Attempt to reload the data from the Weever server using the API
     */
    private function reload_from_server() {
        if ( ! empty( $this->_data['site_key'] ) ) {
        	// Test getting the data using this api key
        	// TODO: Give either the stage URL or blank if live
        	$stage_url = ($this->_data['staging_mode'] ? WeeverConst::LIVE_STAGE : "");

        	$postdata = array(
        				'stage' => $stage_url,
        				'app' => 'json',
        				'site_key' => $this->_data['site_key'],
        				'm' => "tab_sync",
        				'version' => WeeverConst::VERSION,
        				'generator' => WeeverConst::NAME
        				);

        	$result = WeeverHelper::send_to_weever_server($postdata);

        	// Try to decode the result
            $state = json_decode($result);

        	if ( "Site key missing or invalid." == $result ) {
        	    throw new Exception( __( 'Weever Apps API key is not valid' ) );
            } else {
                // Get the settings
                // TODO: Finish this function
                $this->_data['primary_domain'] = $state->results->config->primary_domain;

                // Tabs
                // First load all the tabs then add the subtabs to the main tabs
                $this->_data['tabs'] = array();
                $theme_params = json_decode($state->results->config->theme_params);

                foreach ( $state->results->tabs as $tab ) {
                    if ( $tab->type == 'tab' ) {
                        // Main level tab
                        $icon_image = isset( $theme_params->{$tab->component.'Icon'} ) ? $theme_params->{$tab->component.'Icon'} : false;
                        $this->_data['tabs'][] = new WeeverAppTab( $tab->cloud_tab_id, $tab->component, $tab->name, $tab->published, $tab->ordering, $tab->icon, $icon_image );
                    } else {
                        // Sub-level tab
                        $this->_data['tabs'][] = new WeeverAppSubtab( $tab->cloud_tab_id, $tab->name, $tab->type, $tab->ordering, $tab->published );
                    }
                }

                // Order the tabs
                function tab_order($a, $b) {
                    return ($b->ordering - $a->ordering);
                }

                uksort( $this->_data['tabs'], "tab_order" );

                // Put the subtabs in
                foreach ( $this->_data['tabs'] as $tab ) {
                    if ( ! $tab->is_top_level_tab() ) {
                        // Get the parent tab by the subtab type
                        $parent_tab = $this->get_tab( $tab->type );
                        $parent_tab->add_subtab( $tab );
                    }
                }

                // Re-generate the qr code if needed
                $this->generate_qr_code();
            }
        }
    }

    private function is_valid() {
        return isset( $this->_data['site_key'] ) && ! empty( $this->_data['site_key'] ) && ! empty( $this->_data['primary_domain'] );
    }

    public function & get_device_option_names() {
        $option_names = array_keys( $this->_device_options );
        return $option_names;
    }

    public function & get_tabs($only_top_level = true) {
        if ( ! $only_top_level ) {
            // Return everything
            return $this->_data['tabs'];
        } else {
            $retval = array();

            foreach ( $this->_data['tabs'] as $tab ) {
                if ( $tab->is_top_level_tab() ) {
                    $retval[] = $tab;
                }
            }

            return $retval;
        }
    }

    /*
     * Get a tab
     *
     * @param mixed $id either the int id of the tab or the type/component of a top level tab
     */
    public function & get_tab($id) {
        foreach ( $this->_data['tabs'] as $tab ) {
            if ( $tab->id == $id || ( $tab->is_top_level_tab() && $tab->component == $id ) )
                return $tab;
        }
    }

    /**
     * Generate a QR code and cache it locally
     */
	public function generate_qr_code() {
	    if ( $this->is_valid() ) {
    		if ( $this->staging_mode ) {
    			$type = 'stage';
    			$queryExtra = '&staging=1';
    		} else {
    			$type = 'live';
    			$queryExtra = '';
    		}

    		$qr_site_url = "http://qr.weever.ca/?site=" . $this->primary_domain;
    		$qr_app_url = "http://qr.weever.ca/?site=" . $this->primary_domain . "&preview=1&beta=1" . $queryExtra;

    		// Set the urls to the direct link by default
		    $this->_data['qr_code_private'] = $qr_app_url;
		    $this->_data['qr_code_public'] = $qr_site_url;

    		// See if the uploads folder is accessible, and if so cache the image
    		$uploads = wp_upload_dir();
    		if ( isset( $uploads['basedir'] ) and isset( $uploads['baseurl'] ) ) {
    		    // Try to make the weeverapps sub-folder
    		    if ( wp_mkdir_p( trailingslashit( $uploads['basedir'] ) . 'weeverapps' ) ) {
            		if ( get_option( 'weever_qr_site_'.$type.'_code_time', 0 ) > time() || copy( $qr_site_url, trailingslashit( $uploads['basedir'] ) . 'weeverapps/qr_site_'.$type.'.png' ) ) {
                        $this->_data['qr_code_public'] = trailingslashit( $uploads['baseurl'] ) . 'weeverapps/qr_site_'.$type.'.png';

                        if ( get_option( 'weever_qr_site_'.$type.'_code_time', 0 ) <= time() )
                            // Cache for 1 hour
                            update_option( 'weever_qr_site_'.$type.'_code_time', time() + 60*60 );
            		}

            		if ( get_option( 'weever_qr_app_'.$type.'_code_time', 0 ) > time() || copy( $qr_app_url, trailingslashit( $uploads['basedir'] ) . 'weeverapps/qr_app_'.$type.'.png' ) ) {
                        $this->_data['qr_code_private'] = trailingslashit( $uploads['baseurl'] ) . 'weeverapps/qr_app_'.$type.'.png';

                        if ( get_option( 'weever_qr_app_'.$type.'_code_time', 0 ) <= time() )
                            // Cache for 1 hour
                            update_option( 'weever_qr_app_'.$type.'_code_time', time() + 60*60 );
            		}
            	}
    		}
	    } else {
	        $this->_data['qr_code_private'] = $this->_data['qr_code_public'] = '';
	    }
	}

    /**
     * Save the currently stored configuration to the server
     *
     * @throws exception on error
     */
    public function save() {

        update_option( 'weever_app_enabled', $this->_data['app_enabled'] );
        update_option( 'weever_api_key', $this->_data['site_key'] );
        update_option( 'weever_staging_mode', $this->_data['staging_mode'] );

        // Mobile settings
        foreach ( $this->get_device_option_names() as $option ) {
            update_option( 'weever_device_option_'.$option, $this->_data[$option] );
        }
        update_option( 'weever_granular_devices', $this->_data['granular'] );

        // TODO: Push the configuration to the server


        // Reload the data afterwards to ensure everything was saved
        // TODO: Possibly change the API to return the data
        $this->reload_from_server();
    }

    /**
     * Publish or Unpublish the given local tab ids
     *
     * @param int[] $ids
     * @param int publish flag
     */
    public function save_publish_status($ids, $publish) {

		$postdata = array(
				'published' => $publish,
				'app' =>'ajax',
				'm' => 'publish_tab',
				'site_key' => $this->site_key,
				'local_tab_id' => $ids,
				'version' => WeeverConst::VERSION,
				'generator' => WeeverConst::NAME
				);

		return WeeverHelper::send_to_weever_server($postdata);
    }
}