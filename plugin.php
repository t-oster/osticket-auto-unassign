<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__file__) . '/include');
return [
    'upstart-it:unassign-team', # notrans
    'version' => '1.0 edited',
    'name' => 'Upstart IT Auto Unassign Edited',
    'author' => 'Upstart IT - edited by Angel Andrades',
    'description' => 'If a ticket gets assigned to an agent, unassign the team and vice versa',
    'url' => 'https://github.com/t-oster/osticket-auto-unassign',
    'plugin' => 'UitAutoUnassignEdited.php:UitAutoUnassignEdited'
];
