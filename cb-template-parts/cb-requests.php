<?php
/**
 * Confetti Bits Requests
 * Version 2.3.0
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 

?>
<div class="cb-container" id="cb-requests">
	<?php 
	cb_requests_form();
	cb_templates_ajax_table('requests'); 
	?>
</div>
<?php 