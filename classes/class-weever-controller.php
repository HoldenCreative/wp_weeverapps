<?php

/*
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.2
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/

class WeeverController {

	public static function ajaxSaveTabName() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['id'] );

                if ( $tab !== false ) {
                    try {
                        $tab->name = $_POST['name'];
                        $tab->save();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            }
        } else {
            status_header(401);
        }

        die();
    }

    
	public static function ajaxUpdateTabSettings()
	{
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['id'] );
				$type = $_POST['type'];
				
				switch ( $_POST['type'] ) {
					case "map":
						$submitted_vars = explode( ',', $_POST['var'] );
						
						$tab->var->start->latitude = $submitted_vars[0];
						$tab->var->start->longitude = $submitted_vars[1];
						$tab->var->start->zoom = $submitted_vars[2];
						$tab->var->marker = $submitted_vars[3];
						$tab->save();
						break;
						
					case "panel": 
					case "aboutapp":
						$submitted_vars = explode( ',' , $_POST['var'] );
						
						$tab->var->animation->type = $submitted_vars[0];
						$tab->var->animation->duration = $submitted_vars[1];
						$tab->var->animation->timeout = $submitted_vars[2];
						$tab->var->content_header = $submitted_vars[3];
						
						// TODO: Figure out how to detect changes to the object itself if possible
						$tab->var = $tab->var;
						
						$tab->save();
						break;
				}
            }
		} else {
            status_header(401);
        }

        die();
	}
    
    
	public static function ajaxSubtabDelete() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['id'] );
                if ( $tab !== false ) {
                    try {
                        // Delete this tab
                        $tab->delete();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
		}

		die();
	}

	public function ajaxPublishSelected() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    $weeverapp->publish_tabs( explode( ",", $_POST['ids'] ) );
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
    }

	public function ajaxUnpublishSelected() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    $weeverapp->unpublish_tabs( explode( ",", $_POST['ids'] ) );
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
    }

	public function ajaxDeleteSelected() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    $weeverapp->delete_tabs( explode( ",", $_POST['ids'] ) );
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
	}

	public function ajaxTabPublish() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['id'] );
                if ( $tab !== false ) {
                    try {
                        // Toggle the publish flag based on the status given
                        $tab->published = $_POST['status'] ? 0 : 1;
                        $tab->save();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
		} else {
            status_header(401);
        }

        die();
    }

	public function ajaxSaveTabIcon() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['type'] );

                if ( $tab !== false ) {
                    try {
                        $tab->icon_image = $_POST['icon'];
                        $tab->save();
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    echo __( 'Invalid tab id' );
                    status_header(500);
                }
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
    }

	public function ajaxSaveTabOrder()
	{
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $order = explode( ",", $_POST['order'] );
                foreach ( $order as $k => $o ) {
                    $order[$k] = str_ireplace( 'tabid', '', $o );
                }
                $weeverapp->order_tabs( $order );
            } else {
                status_header(500);
                echo __( 'Unable to communicate with Weever Apps server' );
            }
        } else {
            status_header(401);
        }

        die();
	}


	public function ajaxSaveSubtabOrder() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['type'] );

                if ( $tab !== false ) {
                    try {
                		$tab->move_subtab( $_POST['id'], ( $_POST['dir'] == WeeverAppTab::MOVE_DOWN ? WeeverAppTab::MOVE_DOWN : WeeverAppTab::MOVE_UP ) );
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            }
        } else {
            status_header(401);
        }

        die();
	}

	public function ajaxToggleAppStatus()
	{
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                try {
                    if ( isset( $_POST['app_enabled'] ) ) {
                        // Use the given value
                        $weeverapp->app_enabled = ( $_POST['app_enabled'] ? 1 : 0 );                        
                    } else {
                        // Toggle
                        $weeverapp->app_enabled = ( $weeverapp->app_enabled ? 0 : 1 );
                    }
                    $weeverapp->save();
                } catch ( Exception $e ) {
                    status_header(500);
                    echo $e->getMessage();
                }
            }
        } else {
            status_header(401);
            echo __( 'Authentication error' );
        }

        die();
	}

	public function ajaxSaveNewTab() {
		if ( ! empty($_POST) and check_ajax_referer( 'weever-list-js', 'nonce' ) ) {
            $weeverapp = new WeeverApp();

            if ( $weeverapp->loaded ) {
                $tab = $weeverapp->get_tab( $_POST['type'] );

                if ( $tab !== false ) {
                    try {
                        // Create a new subtab with the given params
                        $tab->create_subtab( $_POST );
                    } catch ( Exception $e ) {
                        status_header(500);
                        echo $e->getMessage();
                    }
                } else {
                    status_header(500);
                    echo __( 'Invalid tab id' );
                }
            }
        } else {
            status_header(401);
            echo __( 'Authentication error' );
        }

        die();
	}

	public function save()
	{

		$option = JRequest::getCmd('option');
		JRequest::checkToken() or jexit('Invalid Token');

		if(JRequest::getVar('view') == "config")
		{
			comWeeverHelper::saveConfig();
			$this->setRedirect('index.php?option=com_weever&view=config&task=config',JText::_('WEEVER_CONFIG_SAVED'));
			return;
		}

		if(JRequest::getVar('view') == "theme")
		{
			comWeeverHelper::saveTheme();
			$this->setRedirect('index.php?option=com_weever&view=theme&task=theme',JText::_('WEEVER_THEME_SAVED'));
			return;
		}

		if(JRequest::getVar('view') == "account")
		{
			if(JRequest::getVar('staging') == 1)
			{
				$row =& JTable::getInstance('WeeverConfig', 'Table');
				$row->load(7);
				$row->setting = 1;
				$row->store();
			}

			comWeeverHelper::saveAccount();

			if(JRequest::getVar("install"))
				$this->setRedirect('index.php?option=com_weever&view=list',JText::_('WEEVER_ACCOUNT_SAVED'));
			else
				$this->setRedirect('index.php?option=com_weever&view=account&task=account',JText::_('WEEVER_ACCOUNT_SAVED'));

			return;
		}

		$tab_id = null;
		$hash = md5(microtime() . JRequest::getVar('name'));

		$type = JRequest::getWord('type', 'tab');

		$type_method = "_build".$type."FeedURL";

		// ### check later
		if(JRequest::getVar('view' == "contact"))
		{
			comWeeverHelper::getContactInfo();
		}

		$rss = comWeeverHelper::$type_method();

		if($rss === false)
		{
			$this->setRedirect('index.php?option=com_weever&view=tab&task=add&layout='.JRequest::getVar('layout', 'blog'), JText::_('WEEVER_MUST_CHOOSE_OPTION_FROM_DROPDOWN'), 'error');
			return;
		}


		JRequest::setVar('rss', $rss, 'post');
		JRequest::setVar('hash', $hash, 'post');
		JRequest::setVar('weever_server_response', comWeeverHelper::pushSettingsToCloud(), 'post');

		if(JRequest::getVar('weever_server_response') == "Site key missing or invalid.")
		{
			$this->setRedirect('index.php?option='.$option.'&view=list', JText::_('WEEVER_SERVER_ERROR').JRequest::getVar('weever_server_response'), 'notice');
			return;
		}

		$row =& JTable::getInstance('weever','Table');


		if(!$row->bind(JRequest::get('post')))
		{
			JError::raiseError(500, $row->getError());
		}

		$row->ordering = $row->ordering + 0.1; // for later reorder to sort well if it is in collision with another.

		if(!$row->store())
		{
			JError::raiseError(500, $row->getError());
		}

		comWeeverHelper::reorderTabs($type);
		comWeeverHelper::pushLocalIdToCloud($row->id, JRequest::getVar('hash'), JRequest::getVar('site_key'));

		if(JRequest::getVar('weever_server_response'))
		{

			if($this->getTask() == 'apply')
				$this->setRedirect('index.php?option='.$option.'&view=tab&task=edit'.'&cid[]='.$row->id,
					JText::_('WEEVER_SERVER_RESPONSE').JRequest::getVar('weever_server_response'));
			else
				$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_SERVER_RESPONSE').JRequest::getVar('weever_server_response'));

			return;
		}
		else
		{
			$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');

			return;
		}

	}

}
