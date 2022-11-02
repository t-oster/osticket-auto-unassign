<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__file__) . '/include');
return [
    'upstart-it:unassign-team', # notrans
    'version' => '1.1',
    'name' => 'Upstart IT Auto Unassign',
    'author' => 'Upstart IT - edited by Angel Andrades',
    'description' => 'If a ticket gets assigned to an agent, unassign the team and vice versa',
    'url' => 'https://github.com/t-oster/osticket-auto-unassign',
    'plugin' => 'UitAutoUnassign.php:UitAutoUnassign'
];
