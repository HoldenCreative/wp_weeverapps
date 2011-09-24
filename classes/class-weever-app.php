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

        // Device detection settings
        $this->_data['granular'] = get_option( 'weever_granular_devices', 0 );
        foreach ( $this->_device_options as $key => $value ) {
             $this->_data[$key] = get_option( 'weever_device_option_'.$key, $value );
        }

        // Stub of rows
        $blogtab = new WeeverAppTab(4, 'blog', 'Blogs', 1);
        $blogtab->add_subtab(new WeeverAppSubtab(7, 'Parks Home', 'blog', rand(1,10), 1));
        $blogtab->add_subtab(new WeeverAppSubtab(15, 'Animals - Category', 'blog', rand(1,10), 1));
        
        $socialtab = new WeeverAppTab(3, 'social', 'Social');
        $socialtab->add_subtab(new WeeverAppSubtab(8, 'Twitter tt', 'social', rand(1,10), 1));
        
        $this->_data['tabs'] = array(new WeeverAppTab(1, 'contact', 'Contact', 1),
                                        new WeeverAppTab(2, 'page', 'Pages', 1),
                                        $socialtab,
                                        $blogtab,
                                        new WeeverAppTab(5, 'photo', 'Photos', 1),
                                        new WeeverAppTab(6, 'video', 'Videos', 1),
                                        new WeeverAppTab(12, 'calendar', 'Events', 1),
                                        new WeeverAppTab(105, 'form', 'Forms', 1),
                                        );
                                                                                
        if ( $load_from_server ) {
            $this->reload_from_server();
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
            }
        }
    }

    public function & get_device_option_names() {
        $option_names = array_keys( $this->_device_options );
        return $option_names;
    }
    
    public function & get_tabs() {
        return $this->_data['tabs'];
    }
    
    public function & get_tab($id) {
        foreach ( $this->_data['tabs'] as $tab ) {
            if ( $tab->id == $id )
                return $tab;
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