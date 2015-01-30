<?php

// register the plugin settings
function pmc_campaign_monitor_register_settings() {
	// register our option
	register_setting( 'pmc_mc_settings_group', 'pmc_mc_settings' );
}
add_action( 'admin_init', 'pmc_campaign_monitor_register_settings', 100 );

function pmc_campaign_monitor_settings_menu() {
	// add settings page
	add_options_page(__('Mail Chimp', 'pmc'), __('Mail Chimp', 'pmc'),'manage_options', 'pippin-mailchimp', 'pmc_settings_page');
}
add_action('admin_menu', 'pmc_campaign_monitor_settings_menu', 100);

function pmc_settings_page() {

	global $pmc_options;

	?>
	<div class="wrap">
		<h2><?php _e('Mail Chimp Settings', 'pmc'); ?></h2>
		<?php
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
			echo '<div class="updated"><p>' . __('Settings saved', 'pmc') . '</p></div>';
		}
		?>
		<form method="post" action="options.php" class="ppmc_options_form">
			<?php settings_fields( 'pmc_mc_settings_group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scop="row">
						<label for="pmc_mc_settings[api_key]"><?php _e( 'Mail Chimp API Key', 'pmc' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" id="pmc_mc_settings[api_key]" style="width: 300px;" name="pmc_mc_settings[api_key]" value="<?php if(isset($pmc_options['api_key'])) { echo esc_attr($pmc_options['api_key']); } ?>"/>
						<p class="description"><?php _e('Enter your mail Chimp API key to enable a newsletter signup option with the registration form.', 'pmc'); ?></p>
					</td>
				</tr>
				<tr>
					<th scop="row">
						<span><?php _e( 'Email Lists', 'pmc' ); ?></span>
					</th>
					<td>
						<?php $lists = pmc_get_lists(); ?>
						<ul>
							<?php
								if($lists) :
									$i = 1;
									foreach($lists as $id => $list_name) :
										echo '<li>' . $list_name . ' - <strong>[mailchimp list="' . $i . '"]</strong></li>';
										$i++;
									endforeach;
								else : ?>
							<li><?php _e('You must enter your API and Client ID keys before lists are shown.', 'pmc'); ?></li>
						<?php endif; ?>
						</ul>
						<p class="description"><?php _e('Place the short code shown beside any list in a post or page to display the signup form, or use the dedicated widget.', 'pmc'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scop="row">
						<label for="pmc_mc_settings[double_opt_in]"><?php _e( 'Double Opt In', 'pmc' ); ?></label>
					</th>
					<td>
						<input class="checkbox" type="checkbox" id="pmc_mc_settings[double_opt_in]" name="pmc_mc_settings[double_opt_in]" value="1" <?php checked(1, isset( $pmc_options['double_opt_in'] ) ); ?>/>
						<span class="description"><?php _e('Require that users confirm their subscriptions?', 'pmc'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scop="row">
						<label for="pmc_mc_settings[disable_names]"><?php _e( 'Disable Names', 'pmc' ); ?></label>
					</th>
					<td>
						<input class="checkbox" type="checkbox" id="pmc_mc_settings[disable_names]" name="pmc_mc_settings[disable_names]" value="1" <?php checked(1, isset( $pmc_options['disable_names'] ) ); ?>/>
						<span class="description"><?php _e('Disable the First and Last Name fields?', 'pmc'); ?></span>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>

		</form>
	</div><!--end .wrap-->
	<?php
}