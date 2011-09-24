<?php

class WeeverAppTab {

    protected $_data = array();
    protected $_changed = array();
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

    public function __set($var, $val) {
        switch ( $var ) {
            case 'id':
                throw new Exception( __( 'Cannot edit the tab id after loading' ) );
                break;
            default:
                if ( array_key_exists( $var, $this->_data ) ) {
                    $this->_data[$var] = $val;
                    $this->_changed[$var] = $var;
                } else {
                    throw new Exception( __( 'Invalid parameter name' ) );
                }
        }
    }

    public function add_subtab(&$subtab) {
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

    /**
     * Function to show if this is a top level (toolbar) tab or not
     *
     * @return bool
     */
    public function is_top_level_tab() {
        return true;
    }

    public function save() {

        // Name change
        if ( isset( $this->_changed['name'] ) ) {
			$postdata = array(
				'name' => $this->name,
				'id' => $this->id,
				'app' => 'ajax',
				'm' => "edit_tab_name",
				'version' => WeeverConst::VERSION,
				'generator' => WeeverConst::NAME
				);

		    $result = WeeverHelper::send_to_weever_server($postdata);

		    if ( $result !== 'Tab Changes Saved' )
		        throw new Exception( __( 'Error saving tab name' ) );
        }

        // TODO: Handle remaining changes

        $this->_changed = array();
    }
}