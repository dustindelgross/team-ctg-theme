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

$cb = Confetti_Bits();

do_action('cb_dashboard_before');

?>
<div class="cb-container active" id="cb-dashboard">

	<?php do_action('cb_dashboard_before'); ?>
	<?php do_action('cb_dashboard'); ?>

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