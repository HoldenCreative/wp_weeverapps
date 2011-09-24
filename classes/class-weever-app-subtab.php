<?php

class WeeverAppSubtab extends WeeverAppTab {

    public function __construct($id, $name, $type, $ordering, $published) {
        $this->_data['id'] = $id;
        $this->_data['name'] = $name;
        $this->_data['type'] = $type;
        $this->_data['ordering'] = $ordering;
        $this->_data['published'] = $published;
    }

    /**
     * Function to show if this is a top level (toolbar) tab or not
     *
     * @return bool
     */
    public function is_top_level_tab() {
        return false;
    }
}