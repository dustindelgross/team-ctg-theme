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
								array(
									'label' => "Please select the event you'd like to register",
									'value'	=> ''
								),
								array(
									'label'		=> 'Dress Up Day',
									'value'		=> 'dress_up',
								),
								array(
									'label'		=> 'Office Lunch',
									'value'		=> 'lunch',
								),
								array(
									'label'		=> 'Holiday',
									'value'		=> 'holiday',
								),
								array(
									'label'		=> 'In-Office Activity',
									'value'		=> 'activity',
								),
								array(
									'label'		=> 'Awareness Day',
									'value'		=> 'awareness',
								),
								array(
									'label'		=> 'Team Meeting',
									'value'		=> 'meeting',
								),
								array(
									'label'		=> "Amanda's Workshop",
									'value'		=> 'workshop',
								),
								array(
									'label'		=> 'Contest',
									'value'		=> 'contest',
								),
								array(
									'label'		=> 'Other',
									'value'		=> 'other',
								),

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
						<div class="cb-flex-container cb-flex-column-nowrap cb-flex-align-start cb-flex-justify-start">
							<p>
								Please provide images that indicate your participation for each selection.<br><span class="cb-info-caption">(A screenshot of an activity post, a handout from the event, etc.)</span>
							</p>
							<div id="cb-dropzone-container">
								<div id='cb-dropzone'>
									<div class="dz-default dz-message">
										<p>
											Drop Files to Upload
										</p>
										<button class="dz-button" type="button">or Click Here</button></div>
								</div>
							</div>
							<div id="cb-previews-container"></div>
							<div id="cb-media-selection"></div>
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
</div>