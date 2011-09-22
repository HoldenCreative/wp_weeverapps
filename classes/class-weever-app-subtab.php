<?php

class WeeverAppSubtab {
    
    private $_data = array();
    
    public function __construct($id, $name, $type, $ordering, $published) {
        $this->_data['id'] = $id;
        $this->_data['name'] = $name;
        $this->_data['type'] = $type;
        $this->_data['ordering'] = $ordering;
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
    
    
    /**
     * Save the settings for this tab id
     * Enter description here ...
     */
    public function save() {
        
    }
}