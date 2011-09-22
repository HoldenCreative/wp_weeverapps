<?php

class WeeverAppTab {
    
    private $_data = array();
    private $_subtabs = array();
    
    public function __construct($id, $component, $name, $published) {
        $this->_data['id'] = $id;
        $this->_data['component'] = $component;
        $this->_data['name'] = $name; 
        $this->_data['icon'] = 'test';
        $this->_data['published'] = $published;
    }

    public function & __get($var) {
        switch ( $var ) {
            default:
                if ( array_key_exists( $var, $this->_data ) )
                    return $this->_data[$var];
                else    
                    throw new Exception( __( 'Invalid parameter name' ) );
        }
    }
    
    public function add_subtab($subtab) {
        $this->_subtabs[] = $subtab;
    }
    
    public function & get_subtabs() {
        return $this->_subtabs; 
    }
    
    public function & get_subtab($id) {
        foreach ( $this->_subtabs as $subtab ) {
            if ( $subtab->id == $id )
                return $subtab;
        }
    }
}