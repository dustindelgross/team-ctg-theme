<?php
/**
 * Confetti Bits Requests
 * Version 2.1.0
 * 
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 
?>
<div class="cb-container" id="cb-requests-admin">
	<?php 
	cb_templates_ajax_table('requests_admin', 'Open Requests'); 
	cb_request_items_form();
	cb_templates_ajax_table('request_items', 'Request Items'); 
	?>
</div>
<?php 