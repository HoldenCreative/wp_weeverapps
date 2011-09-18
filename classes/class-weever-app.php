<?php

class WeeverApp {

    private $_data = array();

    // TODO: Grab most of this data from the API
    public function __construct( $load_from_server = true ) {

        // Initial settings
        $this->_data['theme'] = new WeeverAppThemeStyles();
        $this->_data['appEnabled'] = get_option( 'weever_app_enabled' );
        $this->_data['site_key'] = get_option( 'weever_api_key' );
        $this->_data['tabRows'] = array();

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

    public function reload_from_server() {
        if ( ! empty( $this->_data['site_key'] ) )
        {

        }
    }
}