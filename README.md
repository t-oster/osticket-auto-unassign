# osticket-auto-unassign
This plugin unassigns a team or agent whenever the other is assigned, so a ticket is always either assigned to an agent or a team (not both) (based on https://forum.osticket.com/d/90581-need-to-be-able-to-unassign-team-when-reassigning-to-an-individual/8)

It has been edited on 27.10.2022 to make it compatible with osTicket v1.17 (1d8b790)
As well to have the following two options:
	- Unassigns a team or agent whenever the other is assigned, so a ticket is always either assigned to an agent or a team (not both)
	- Unassigns automatically the Agent when assigning the ticket to another Team. (A ticket can then be assigned to a Team and an Agent at the same time)

 Note: if you use the "Claim on Response" (autoclaim) feature it does not fire the object.edited signal so the ticket will remain assigned to both responder and team. You can remedy this by adding two lines to the autoclaim routine in class.ticket.php
	 // Claim on response bypasses the department assignment restrictions
	        $claim = ($claim
	                && $cfg->autoClaimTickets()
	                && !$dept->disableAutoClaim());
	        if ($claim && $thisstaff && $this->isOpen() && !$this->getStaffId()) {
	            $this->setStaffId($thisstaff->getId()); //direct assignment;
	            $type = array('type' => 'assigned', $key => true); // <==== Add This
	            Signal::send('object.edited', $this, $type); // <=== And This
	        }
