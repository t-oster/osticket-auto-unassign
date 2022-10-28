<?php

require_once (INCLUDE_DIR . 'class.plugin.php');
require_once (INCLUDE_DIR . 'class.signal.php');
require_once (INCLUDE_DIR . 'class.app.php');

require_once('config.php'); // Added on 27.10.2022

class UitAutoUnassignEdited extends Plugin {
	var $config_class = 'UitAutoUnassignEditedConfig'; // Added on 27.10.2022
    public function bootstrap() {
        //catch the signal from Ticket::assignToStaff
        Signal::connect('object.edited', function($ticket, $type) {
			$config = $this->getConfig();
            if (
                $ticket instanceof Ticket
                && is_array($type)
                && array_key_exists("type", $type)
                && $type["type"] == "assigned"
                && $ticket->getStaffId() > 0
                && $ticket->getTeamId() > 0
            ) {
				// Added on 27.10.2022
				switch($config->get('unassign_options')){ 
					case 'one_assign':
						if (array_key_exists("team", $type)) {
							//assigned to team, remove agent
							$ticket->setStaffId(0);
							//$ticket->logNote("Unassigned", "Plugin dummy: Assignment zum Agent aufgehoben: ".print_r($type, true));
						}
						else {
							//assignment ot agent, remove team
							$ticket->setTeamId(0);
							//$ticket->logNote("Unassigned", "Plugin dummy: Assignment zum Team aufgehoben: ".print_r($type, true));
						}
						break;
					case 'unassign_agent':
						if (array_key_exists("team", $type)) {
							//assigned to team, remove agent
							$ticket->setStaffId(0);
							//$ticket->logNote("Unassigned", "Plugin dummy: Assignment zum Agent aufgehoben: ".print_r($type, true));
						}
						break;
				}	
				
            }
                    
        });
    }
	
	 /**
     * Required stub.
     *
     * {@inheritdoc}
     *
     * @see Plugin::uninstall()
     */
    function uninstall(&$errors) {
        $errors = array();
        global $ost;
        // Send an alert to the system admin:
        $ost->alertAdmin(self::PLUGIN_NAME . ' has been uninstalled', "You wanted that right?", true);

        parent::uninstall($errors);
    }

    /**
     * Plugins seem to want this.
     */
    public function getForm() {
        return array();
    }

}
