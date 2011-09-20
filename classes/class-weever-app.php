<?php

class WeeverApp {

    private $_data = array();

    // TODO: Grab most of this data from the API
    public function __construct( $load_from_server = true ) {

        // Initial settings
        $this->_data['theme'] = new WeeverAppThemeStyles();
        $this->_data['appEnabled'] = get_option( 'weever_app_enabled' );
        $this->_data['site_key'] = get_option( 'weever_api_key' );

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

    public function reload_from_server() {
        if ( ! empty( $this->_data['site_key'] ) )
        {

        }
    }
}