<?php

require_once (INCLUDE_DIR . 'class.plugin.php');
require_once (INCLUDE_DIR . 'class.signal.php');
require_once (INCLUDE_DIR . 'class.app.php');

class UitUnassignTeam extends Plugin {

    public function bootstrap() {
        //catch the signal from Ticket::assignToStaff
        Signal::connect('object.edited', function($ticket, $type) {
            if (
                $ticket instanceof Ticket
                && is_array($type)
                && array_key_exists("type", $type)
                && $type["type"] == "assigned"
                && $ticket->getStaffId() > 0
                && $ticket->getTeamId() > 0
            ) {
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
            }
                    
        });
    }

}
