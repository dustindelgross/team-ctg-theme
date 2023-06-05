<?php
/**
 * Confetti Bits Requests
 * Version 2.1.0
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="cb-container" id="cb-requests">
	<div class="cb-module">
		<?php 
		cb_templates_heading("Send a New Request");
		cb_transactions_request_balance_notice(); 
		?>
		<form class="cb-form" method="post" name="cb_request_form" id="cb_request_form" autocomplete="off">
		
			<?php 
			cb_transactions_request_selection();
			
			cb_number_input([
				"name" => "cb_request_amount",
				"label" => "Bits Cost",
				"readonly" => true
			]);

			cb_submit_input(["name" => "cb_send_bits_request"]);

			?>
		</form>
	</div>
</div>
<?php 