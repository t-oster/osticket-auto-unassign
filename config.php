<?php

//require_once(INCLUDE_DIR.'class.forms.php');
require_once INCLUDE_DIR . 'class.plugin.php';
require_once INCLUDE_DIR.'class.forms.php';

// Created on 27.10.2022 Angel Andrades

class UitAutoUnassignConfig extends PluginConfig {
	
	// Provide compatibility function for versions of osTicket prior to
    // translation support (v1.9.4)
    function translate() {
        if (!method_exists('Plugin', 'translate')) {
            return array(
                function($x) { return $x; },
                function($x, $y, $n) { return $n != 1 ? $y : $x; },
            );
        }
        return Plugin::translate('auto-unassign');
    }
	
    function getOptions() {
        return array(
		
            /*'unassign_agent' => new BooleanField(array(
                'label' => __('Unassign Agent'),
                'default' => true,
                'configuration' => array(
                    'desc' => __('Release Assigned Agent when assigning to another Team')
                )			
            )),*/
			'unassign_options' => new ChoiceField([
                'label' => __('Unassign Options'),
                'required' => false,
                'hint' => __('Select what the osTicket should do when the assigned Agent ou Team is changed.'),
                'default' => 'unassign_agent',
                'choices' => array(
                    'unassign_agent' => __('Release assigned Agent when assigning to another Team. Tickets will always stay assigned to a Team'),
					'one_assign' => __('Unassign a Team or Agent whenever the other is assigned'),
                )
            ])
        );
    }
    function pre_save(&$config, &$errors) {
        global $msg;
        if (!$errors)
            $msg = __('Configuration updated successfully');
        return true;
    }
}
