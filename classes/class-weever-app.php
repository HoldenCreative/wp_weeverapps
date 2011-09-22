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
        $blogTabRow = new stdClass();
        $blogTabRow->component = "blog";
        $blogTabRow->name = "Blogs";
        $socialTabRow = new stdClass();
        $socialTabRow->component = "social";
        $socialTabRow->name = "Social";
        $photoRow = new stdClass();
        $photoRow->component = 'photo';
        $photoRow->name = 'Photos';
        $pageRow = new stdClass();
        $pageRow->component = 'page';
        $pageRow->name = 'Pages';
        $videoRow = new stdClass();
        $videoRow->component = 'video';
        $videoRow->name = 'Videos';
        $contactRow = new stdClass();
        $contactRow->component = 'contact';
        $contactRow->name = 'Contact';
        $calendarRow = new stdClass();
        $calendarRow->component = 'calendar';
        $calendarRow->name = 'Events';
        $formRow = new stdClass();
        $formRow->component = 'form';
        $formRow->name = 'Forms';

        $this->_data['tabRows'] = array($socialTabRow, $blogTabRow, $photoRow, $pageRow, $videoRow, $contactRow, $calendarRow, $formRow);

        // Stub of subrows for each tab
        $subrow = array();
        $subrow[0] = new stdClass();
        $subrow[0]->id = 5;
        $subrow[0]->name = 'Parks Home';
        $subrow[0]->type = 'blog';
        $subrow[0]->ordering = rand(1, 10);
        $subrow[0]->published = 1;

        $subrow[1] = new stdClass();
        $subrow[1]->id = 7;
        $subrow[1]->name = 'Another Blog';
        $subrow[1]->type = 'blog';
        $subrow[1]->ordering = rand(1, 10);
        $subrow[1]->published = 0;

        $this->_data['blogRows'] = $subrow;
        $this->_data['formRows'] = $this->_data['socialRows'] = $this->_data['photoRows'] = $this->_data['pageRows'] = $this->_data['videoRows'] = $this->_data['contactRows'] = $this->_data['calendarRows'] = array();
        $this->_data['socialRows'] = $subrow;

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
        	$server = ($this->_data['staging_mode'] ? WeeverConst::LIVE_STAGE : WeeverConst::LIVE_SERVER);

        	$postdata = http_build_query(
        			array(
        				'stage' => $stage_url,
        				'app' => 'json',
        				'site_key' => $this->_data['site_key'],
        				'm' => "tab_sync",
        				'version' => WeeverConst::VERSION,
        				'generator' => WeeverConst::NAME
        				)
        			);

        	$result = wp_remote_get( $server."?".$postdata );

        	if ( is_array( $result ) and isset( $result['body'] ) ) {
        	    $state = json_decode($result['body']);

            	if ( "Site key missing or invalid." == $result['body'] ) {
            	    throw new Exception( __( 'Weever Apps API key is not valid' ) );
                } else {
                    // Get the settings
                    // TODO: Finish this function
                    $this->_data['primary_domain'] = $state->results->config->primary_domain;
                }
        	} else {
        	    throw new Exception( __( 'Error trying to retrieve settings from Weever Apps server' ) );
        	}
        }
    }

    public function & get_device_option_names() {
        $option_names = array_keys( $this->_device_options );
        return $option_names;
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
}