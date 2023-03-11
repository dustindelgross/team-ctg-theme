<?php 
$types	= array( 'new', 'approved', 'denied', 'all' );
$active = '';

?>

<div class="cb-container" id="cb-participation-admin">
	<div class="cb-module">
		<div class="cb-participation-admin">
			<?php  ?>
			<div style="width:100%;display:flex;justify-content:flex-start;flex-flow:row wrap;align-items:center;gap:10px;">
				<?php 

				$filter_options = array(
					array(
						'label' => "Please select an option",
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
						'name'				=> 'cb_participation_admin_event_type_filter',
						'label'				=> 'Filter By Event Type',
						'required'			=> false,
						'select_options'	=> $filter_options
					)
				);

				?>
			</div>
			<?php  ?>
			<ul class="cb-participation-admin-nav">
				<?php 
				foreach ( $types as $type ) {
					$active = ( $type === 'new' ) ? 'active' : '';
					echo sprintf("<li class='cb-participation-admin-nav-item %s'>
									<a href='#cb-participation-%s' class='cb-participation-admin-nav-link'>%s</a>
									</li>", $active, $type, ucfirst( $type ) );
				}
				?>
			</ul>
			<div class="cb-participation-admin-action-bar">
				<div class="cb-participation-admin-bulk-action-container" >
					<form id="cb_participation_admin_bulk_edit_form">
						<div style="display:flex;flex-flow:row nowrap; align-items: center;
									gap: 1rem;">
							<?php 					
							cb_select_input(
								array(
									'name'				=> 'cb_participation_admin_bulk_action',
									'label'				=> 'Bulk Edit',
									'required'			=> false,
									'select_options'	=> array(
										array(
											'label'		=> 'Please select an option',
											'value'		=> ''
										),
										array(
											'label'		=> 'Approve',
											'value'		=> 'approved'
										),
										array(
											'label'		=> 'Deny',
											'value'		=> 'denied'
										),
									)
								)
							);
							?>
							<input type="submit" id="cb_participation_admin_bulk_edit_submit" value="Apply" />
						</div>
					</form>
				</div>
				<div class="cb-participation-pagination-container">
					<div class="cb-participation-pagination">
						<button class="cb-participation-pagination-button cb-participation-pagination-first" data-cb-participation-page="1" >«</button>
						<button class="cb-participation-pagination-button cb-participation-pagination-previous" data-cb-participation-page="" >‹</button>
						<button class="cb-participation-pagination-button cb-participation-pagination-next" data-cb-participation-page="" >›</button>
						<button class="cb-participation-pagination-button cb-participation-pagination-last" data-cb-participation-page="" >»</button>
					</div>
				</div>
			</div>

			<?php 

			foreach ( $types as $type ) {
				$active = ( $type === 'new' ) ? 'active' : '';
				echo sprintf("<div class='cb-participation-admin-panel %s' 
				id='cb-participation-%s'></div>", $active, $type );
			}
			?>
			<table id="cb-participation-admin-table">

			</table>
		</div>

		<div id="cb-participation-file-viewer-wrapper">
			<div id="cb-participation-file-viewer-container">
				<button id="cb-participation-file-view-close"></button>
				<div id="cb-participation-thumbnail-container"></div>
				<div id="cb-participation-file-viewer"></div>
			</div>
		</div>
		<div id="cb-participation-admin-edit-form-wrapper">
			<div id="cb-participation-admin-edit-form-container">
				<div id="cb-participation-admin-edit-form">
					<button id="cb-participation-admin-edit-form-close"></button>
					<form method="post" enctype="multipart/form-data">

						<div class="cb-participation-admin-edit-form-applicant-data">
							<div>
								<h4 style="margin: 4px 0;">Applicant:</h4>
								<p id="cb-participation-admin-applicant-name"></p>
							</div>
							<div>
								<h4 style="margin: 4px 0;">Event Type:</h4>
								<p id="cb-participation-admin-applicant-event"></p>
							</div>
						</div>
						<?php 

						cb_select_input(
							array(
								'name'				=> 'cb_participation_approval_status',
								'label'				=> 'Approval Status',
								'required'			=> true,
								'select_options'	=> array(
									array(
										'label'		=> 'Please select an option',
										'value'		=> ''
									),
									array(
										'label'		=> 'Approve',
										'value'		=> 'approved'
									),
									array(
										'label'		=> 'Deny',
										'value'		=> 'denied'
									),
								)
							)
						);

						cb_number_input(
							array(
								'label'		=> 'Amount',
								'name'		=> 'cb_participation_amount_override',
								'min'		=> 5,
								'max'		=> 50,
								'disabled'	=> true
							)
						);

						cb_text_input(
							array(
								'label'		=> 'Notes',
								'name'		=> 'cb_participation_admin_log_entry',
								'required'	=> true
							)
						);

						cb_hidden_input(
							array(
								'name'	=> 'cb_participation_event_date',
								'value'	=> ''
							)
						);

						cb_hidden_input(
							array(
								'name'	=> 'cb_participation_admin_id',
								'value'	=> get_current_user_id()
							)
						);

						cb_hidden_input(
							array(
								'name'	=> 'cb_participation_id',
								'value'	=> ''
							)
						);

						cb_hidden_input(
							array(
								'name'	=> 'cb_participation_applicant_id',
								'value'	=> ''
							)
						);

						cb_hidden_input(
							array(
								'name'	=> 'cb_participation_event_type',
								'value'	=> ''
							)
						);

						cb_hidden_input(
							array(
								'name'	=> 'cb_participation_transaction_id',
								'value'	=> ''
							)
						);

						wp_nonce_field( 'cb_participation_admin_post', 'cb_participation_admin_nonce' );
						cb_submit_input();
						?>
					</form>
				</div>
			</div>
			<?php if ( cb_is_user_site_admin() ) { ?>
			<div class="cb-participation-admin-applicant-history-container">
				<table id="cb-participation-admin-applicant-history">

				</table>
			</div>
			<?php 	} ?>
		</div>
	</div>
</div>
<?php 