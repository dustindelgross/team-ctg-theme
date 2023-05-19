<?php
/*
 *
 * Confetti Bits Member Dashboard
 * @since Version 1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( cb_is_user_site_admin() ) {
}


?>
<div class="cb-container active" id="cb-dashboard">
	<div class="cb-module">
		<div class="cb-leaderboard">
			<h4 class="cb-heading">
				Confetti Cannon Top 15
			</h4>

			<?php cb_leaderboard(); ?>

		</div>

	</div>
	<div class="cb-module">
		<h4 class="cb-heading">
			Send Bits to Team Members
		</h4>
		<p class="cb-counter">
			<?php 
			if ( !cb_is_user_admin() || cb_is_user_site_admin() ) {
				cb_transactions_transfer_balance_notice();
			}
			?>
		</p>
		<form class="cb-form" method="post" name="cb_transactions_send_bits_form" id="cb_transactions_send_bits_form" action="<?php echo  bp_get_canonical_url(); ?>" autocomplete="off">
			<ul class="cb-form-page-section" id="cb-send-bits-data">

				<?php /* ?>

				<li class="cb-form-line">
					<label class="cb-form-label-top" for="cb_transactions_recipient_name">Team Member</label>
					<input class="cb-form-textbox" 
						   type="text" 
						   name="cb_transactions_recipient_name" 
						   id="cb_transactions_recipient_name" 
						   readonly="true" 
						   value="" 
						   placeholder="Select a team member from the search panel" style="color:#9a9a9a;">
				</li>
				<?php }  else { */

				cb_text_input(
					array(
						"label"			=> "Team Member",
						"name"			=> "cb_transactions_recipient_name",
						"placeholder"	=> "Search for a team member",
					)
				);

				cb_toggle_switch(
					array(
						'name'		=> 'cb_transactions_add_activity',
						'label'		=> "I want this to show up on the activity feed",
					)
				);

				?>
				<ul id="cb_transactions_member_search_results"></ul>
				<?php  // } ?>

				<li class="cb-form-line">
					<input class="cb-form-textbox" 
						   type="hidden" 
						   name="cb_transactions_recipient_id" 
						   id="cb_transactions_recipient_id" 
						   value="" 
						   placeholder="">
				</li>

				<?php 
				
				cb_templates_text_input(array(
					'label' => "Log Entry",
					'name' => "cb_transactions_log_entry",
					'placeholder' => "Let them know what it's for!"
				));

				?>

				<li class="cb-form-line">
					<label class="cb-form-label-top" for="cb_transactions_amount" >Amount to Send</label>
					<input class="cb-form-textbox" 
						   type="number" 
						   min="1" 
						   max="20" 
						   name="cb_transactions_amount" 
						   id="cb_transactions_amount"  
						   value="">
				</li>

				<li class="cb-form-line">
					<input class="cb-submit" 
						   type="submit"
						   name="cb_transactions_send_bits"
						   id="cb_transactions_send_bits"
						   action="<?php echo  wp_nonce_url(bp_get_canonical_url(), 'cb-send-bits'); ?>" 
						   value="Submit">
				</li>
			</ul>
			<input type="hidden" 
				   readonly="true" 
				   name="cb_transactions_sender_id" 
				   id="cb_transactions_sender_id" 
				   value="<?php echo get_current_user_id(); ?>" />
		</form>
		<p class="cb-counter">
			<?php cb_transactions_total_sent_today_notice(); ?>
		</p>

	</div>


	<div class="cb-module">
		
		<?php cb_templates_heading("Export Log Entries"); ?>

		<form enctype="multipart/form-data" id="export-download-form" method="post" >
			<ul class="cb-form-page-section" id="cb-export-data">
				<li class="cb-form-line">
					<label class="cb-form-label-top" for="cb_export_type">Export Options</label>
					<select class="cb-form-textbox cb-form-selector"
							name="cb_export_type"
							id="cb_export_type"
							placeholder="">
						<option value="self" selected>My Transactions</option>
						<option value="current_cycle_leaderboard">Leaderboard Top 15</option>
						<option value="previous_cycle_leaderboard">Last Cycle's Leaderboard</option>
						<?php if ( cb_is_user_executive() ) { ?>
						<option value="leadership">Leadership Transactions</option>
						<option value="current_cycle_totals">All Totals (Current)</option>
						<option value="previous_cycle_totals">All Totals (Previous Cycle)</option>
						<?php } ?>
						<?php if ( cb_is_user_requests_fulfillment() ) { ?>
						<option value="current_requests">Requests</option>
						<?php } ?>

					</select>
				</li>

				<li class="cb-form-line">
					<label class="cb-form-label-top" for="cb_export_logs">Export a .csv file of your transaction history</label>
					<input type="submit" id="cb_export_logs" name="cb_export_logs" value="Submit" class="cb-submit">
				</li>
			</ul>
		</form>
	</div>


	<?php
	$erica = get_user_by( 'email', 'erica@celebrationtitlegroup.com' );
	if( cb_is_user_site_admin() || get_current_user_id() == $erica->ID ) {
	?>

	<div class="cb-module">
		<?php cb_templates_heading("Send out a Sitewide Notice"); ?>
		<form enctype="multipart/form-data" id="sitewide-notice-form" method="post" >
			<?php
		cb_text_input(
			array(
				'name'			=> 'cb_sitewide_notice_heading',
				'label'			=> 'Sitewide Notice Heading',
				'placeholder'	=> 'ex. &quot;New Confetti Bits Update Live&quot;'
			)
		);

		cb_text_input(
			array(
				'name'			=> 'cb_sitewide_notice_body',
				'label'			=> 'Sitewide Notice Body Text',
				'placeholder'	=> 'ex. &quot;There is a new update available for Confetti Bits. Follow this link to...&quot;',
				'textarea'		=> true
			)
		);
		wp_nonce_field( 'cb_sitewide_notice_post', 'cb_sitewide_notice_nonce' );
		cb_hidden_input(
			array(
				'name' => 'cb_sitewide_notice_user_id',
				'value'	=> get_current_user_id()
			)
		);
		cb_submit_input();
			?>
		</form>
	</div>
	<?php
	}


	if ( cb_is_user_site_admin() ) {
	?>

	<div class="cb-module">
		<?php

		$bytes      = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
		$size       = size_format( $bytes );
		$upload_dir = wp_upload_dir();

		cb_templates_heading("Import a List of Users"); ?>

		<form enctype="multipart/form-data" id="import-upload-form" method="post" >
			<ul class="cb-form-page-section" id="cb-import-data">
				<li class="cb-form-line">
					<label class="cb-form-label-top" for="import">Please choose a .csv file from your computer</label>
					<input type="file" id="import" name="import" accept=".csv" />
				</li>
				<li class="cb-form-line">
					<p><?php printf( __( 'Maximum size: %s' ), $size ); ?></p>
				</li>
			</ul>
			<div class="submit">
				<input type="hidden" name="cb_bits_imported" value="" />
				<input type="submit" class="button button-primary" value="Import" />

			</div>
		</form>
	</div>
	<div class="cb-module">

		<?php cb_templates_heading("Import Birthdays and Anniversaries"); ?>

		<form enctype="multipart/form-data" id="cb-bda-import-form" method="post">
			<ul class="cb-form-page-section">
				<li class="cb-form-line">
					<label class="cb-form-label-top" for="import">Please choose a .csv file from your computer</label>
					<input type="file" id="import" name="import" accept=".csv" />
				</li>
			</ul>
			<div class="submit">
				<input type="hidden" name="cb_bda_import" value="" />
				<input type="submit" class="button button-primary" value="Import" />

			</div>
		</form>
	</div>
	<?php
	} ?>
</div>