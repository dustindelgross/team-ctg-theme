<div class="cb-container" id="cb-participation-admin">
	<div class="cb-module">
		<div class="cb-participation-admin">
			<div style="width:100%;display:flex;justify-content:flex-start;flex-flow:row wrap;align-items:center;gap:10px;">
				<?php 
				cb_participation_event_type_filter(); 
				cb_participation_admin_nav();
				?>
			</div>
			<div class="cb-participation-admin-action-bar">
				<div class="cb-participation-admin-bulk-action-container" >
					<form id="cb_participation_admin_bulk_edit_form">
						<div style="display:flex;flex-flow:row nowrap; align-items: center;
									gap: 1rem;">
							<?php 					
							cb_select_input([
								'name' => 'cb_participation_admin_bulk_action',
								'label' => 'Bulk Edit',
								'required' => false,
								'placeholder' => 'Please select an option',
								'select_options' => [
									'Approve' => ['value' => 'approved'],
									'Deny' => ['value' => 'denied'],
								]
							]);
							?>
							<input 
								   type="submit" 
								   class="cb-submit-input" 
								   id="cb_participation_admin_bulk_edit_submit" 
								   value="Apply" 
								   />
						</div>
					</form>
				</div>
				<?php cb_templates_ajax_table('participation_admin'); ?>
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

							cb_select_input([
								'name' => 'cb_participation_admin_approval_status',
								'label' => 'Approval Status',
								'placeholder' => 'Please select an option',
								'required' => true,
								'select_options' => [
									'Approve' => ['value' => 'approved'],
									'Deny' => ['value' => 'denied'],
								],
							]);


							cb_number_input([
								'label'		=> 'Amount',
								'name'		=> 'cb_participation_admin_amount_override',
								'min'		=> 5,
								'max'		=> 50,
								'disabled'	=> true
							]);

							cb_text_input([
								'label'		=> 'Notes',
								'name'		=> 'cb_participation_admin_log_entry',
								'required'	=> true
							]);

							cb_hidden_input([
								'name'	=> 'cb_participation_admin_event_date',
								'value'	=> ''
							]);

							cb_hidden_input([
								'name'	=> 'cb_participation_admin_admin_id',
								'value'	=> get_current_user_id()
							]);

							cb_hidden_input([							
								'name'	=> 'cb_participation_admin_participation_id',
								'value'	=> ''
							]);

							cb_hidden_input([
								'name'	=> 'cb_participation_admin_applicant_id',
								'value'	=> ''
							]);

							cb_hidden_input([
								'name'	=> 'cb_participation_admin_event_type',
								'value'	=> ''
							]);

							cb_hidden_input([
								'name'	=> 'cb_participation_admin_transaction_id',
								'value'	=> ''
							]);

							wp_nonce_field( 'cb_participation_admin_post', 'cb_participation_admin_nonce' );
							cb_submit_input();
							?>
						</form>
					</div>
					<?php cb_templates_ajax_table('participation_admin_transactions'); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<?php 