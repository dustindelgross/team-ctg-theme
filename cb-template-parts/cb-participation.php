<div class="cb-container" id="cb-participation">
	<div class="cb-module">
		<div class="cb-participation">
			<div class="cb-flex-container cb-flex-column-nowrap cb-flex-align-start cb-flex-justify-start">
				<h4 class="cb-heading">
					Confetti Bits Participation
				</h4>
				<p style="">
					Submit your registration information here.
				</p>
			</div>
			<div class="cb-flex-container cb-flex-column-nowrap cb-flex-align-start cb-flex-justify-start">
				<form style="width:100%;" enctype="multipart/form-data" method="post" action="<?php echo trailingslashit( bp_core_get_user_domain( get_current_user_id() ) . 'confetti-bits' ); ?>" id="cb-participation-upload-form">
					<div class="cb-flex-container cb-flex-row-wrap cb-flex-align-start cb-flex-justify-space-between cb-flex-column-gap-m">
						<div class="cb-flex-container cb-flex-column-nowrap">

							<?php 

							if ( cb_is_user_participation_admin() || cb_is_user_executive() ) {
								cb_toggle_switch(
									array(
										'name'		=> 'cb_participation_substitute',
										'label'		=> "I'm submitting participation for someone else",
									)
								);

								cb_text_input(
									array(
										'name'		=> 'cb_participation_substitute_member',
										'label'		=> '',
										'disabled'	=> true,
										'placeholder'		=> 'Search for a team member',
										'container_classes'	=> array('cb-participation-substitute-member-container'),
									)
								);
							}

							$options = array(
								"Please select the event you'd like to register" => array('value' => ''),
								'Dress Up Day' => array('value' => 'dress_up'),
								'Office Lunch' => array('value'	=> 'lunch'),
								'Holiday' => array('value' => 'holiday'),
								'In-Office Activity' => array('value' => 'activity'),
								'Awareness Day' => array('value' => 'awareness'),
								'Team Meeting' => array('value'	=> 'meeting'),
								"Amanda's Workshop" => array( 'value' => 'workshop' ),
								'Contest' => array('value' => 'contest'),
								'Other' => array('value' => 'other'),
							);
							cb_select_input(
								array(
									'name'				=> 'cb_participation_event_type',
									'label'				=> 'Select or Describe the Event Type',
									'select_options'	=> $options,
									'required'			=> true
								)
							);

							cb_text_input(
								array(
									'label'			=> 'Notes:',
									'name'			=> 'cb_participation_event_note',
									'placeholder'	=> "ex: Bobby's Bandits Event"
								)
							);

							?>
							<ul class="cb-form-page-section">
								<li class="cb-form-line">
									<label for="cb_participation_event_date">Event Date</label>
									<input required 
										   type="date" 
										   name="cb_participation_event_date" 
										   id="cb_participation_event_date" 
										   class="cb-form-datepicker">
								</li>
							</ul>
						</div>
					</div>
					<?php 

					cb_hidden_input(
						array(
							'name'	=> 'cb_applicant_id',
							'value'	=> get_current_user_id()
						)
					);

					cb_hidden_input(
						array(
							'name'	=> 'action',
							'value'	=> 'cb_upload'
						)
					);

					cb_submit_input();

					?>

				</form>
			</div>
		</div>
	</div>
	<div style="width: 100%; margin-top: 2rem;">
		<div id="cb-participation-log-container">
			<?php cb_templates_heading("My Participation Submissions"); ?>
			<div class="" style="display:flex;flex-flow: row wrap;justify-content:center;align-items:center;gap:1rem;">
				<div style="display:flex;justify-content:center;flex-flow:row wrap;align-items:center;gap:10px;flex: 1 1 200px;">
					<?php 
					cb_participation_event_type_filter(); 
					cb_participation_nav();
					?>
				</div>
				
				<?php cb_templates_ajax_table('participation'); ?>
			</div>
		</div>
	</div>
</div>