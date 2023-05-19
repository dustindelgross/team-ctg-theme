<div class="cb-container" id="cb-events">
	<div class="cb-module">
		<h4 class="cb-heading">
			Confetti Bits Events
		</h4>
		<p>
			Use this form to create and update company culture events.
		</p>
		<form>
			<?php 
			cb_text_input(array(
				'label'				=> 'Event Title',
				'name'				=> 'cb_event_title'
			));
			cb_toggle_switch(array(
				'name'	=> 'cb_recurring_event',
				'label'	=> 'This is a recurring event'
			));
			
			cb_text_input(array(
				'label'	=> 'Event Start Date',
				'name'	=> 'cb_event_start_date'
			));
			
			?>
		</form>
	</div>
</div>