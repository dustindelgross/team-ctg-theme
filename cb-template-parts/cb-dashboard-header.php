<?php cb_transactions_balances_notice(); ?>
<div class="cb-dashboard-header">
	<div class="cb-hub-nav-toggle"></div>
	<div class="cb-hub-nav-container">
		<?php 

		$templates = cb_get_active_templates();
		if ( isset($templates['Dashboard Header'] ) ) {
			unset($templates['Dashboard Header']);
		}

		foreach( $templates as $label => $tag ) {

		?>
		<div class="cb-hub-nav-item cb-<?php echo $tag; ?>-toggle<?php echo ( $tag === 'dashboard' ) ? ' active' : ''; ?>">
			<a href="#cb-<?php echo $tag; ?>" class="cb-hub-nav-link"><?php  echo $label; ?></a>
		</div>

		<?php
		}
		?>
	</div>
</div>
<div class="cb-feedback">
	<button class="cb-close"></button>
	<p class="cb-feedback-message"></p>
</div>
<div class="cb-destruct-feedback">
	<button class="cb-close"></button>
	<div>
		<p class="cb-destruct-feedback-message"></p>
		<div style="display:flex;flex-flow: row nowrap; gap: 1rem;">
			<button class='cb-destruct-cancel'>Nevermind</button>
			<button class='cb-destruct-confirm'>I Understand</button>
		</div>
	</div>
</div>