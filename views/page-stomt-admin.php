<style>
	img#feedback-callout {
		bottom: 50%;
		right: 50px;
		position: fixed;
	}
	
	@media only screen and (max-width: 1060px) {
		img#feedback-callout {
			width: 150px;
		}
	}
	
	@media only screen and (max-width: 800px) {
		img#feedback-callout {
			display: none;
		}
	}
</style>

<div class="wrap">
	
	<h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
	
	<?php
		Stomt::view( 'getting-started' );
	?>
	
	<form action="options.php" method="post" class="card">
	
		<?php
			settings_fields( 'stomt_options' );
			do_settings_sections( 'stomt-admin' );
			submit_button( esc_html__( 'Save Settings', 'stomt' ) );
		?>
		
	</form>

	<?php
		$options = Stomt::get_options_with_default();
		$options['targetId'] = STOMT_PLUGIN_USERNAME;
		include( STOMT_PLUGIN_VIEWS_DIR . 'script.js.php' );
	?>

</div>
