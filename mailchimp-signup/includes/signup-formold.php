<?php

// displays the campaign_monitor signup form
function pmc_mc_form($redirect, $list_id, $message) {
	global $pmc_options, $post;
	if(strlen(trim($message)) <= 0) {
		$message = __('You have been successfully subscribed', 'pmc');
	}
	if(strlen(trim($redirect)) <= 0) {
		if (is_singular()) :
			$redirect =  get_permalink($post->ID);
		else :
			$redirect = 'http';
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $redirect .= "s";
			$redirect .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") $redirect .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			else $redirect .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		endif;
	}
	ob_start();
		if(isset($_GET['submitted']) && $_GET['submitted'] == '1') {
			echo '<p>' . $message . '</p>';
		} else {
			if(strlen(trim($pmc_options['api_key'])) > 0 ) { ?>
			<form id="pmc_mailchimp" action="" method="post">
				<?php if( !isset($pmc_options['disable_names'])) { ?>
					<div>
						<label for="pmc_fname"><?php _e('Enter your first name', 'pmc'); ?></label><br/>
						<input name="pmc_fname" id="pmc_fname" type="text" placeholder="<?php _e('Your first name', 'pmc'); ?>"/>
					</div>
					<div>
						<label for="pmc_lname"><?php _e('Enter your last name', 'pmc'); ?></label><br/>
						<input name="pmc_lname" id="pmc_lname" type="text" placeholder="<?php _e('Your last name', 'pmc'); ?>"/>
					</div>
				<?php } ?>
				<div>
					<label for="pmc_email"><?php _e('Enter your email', 'pmc'); ?></label><br/>
					<input name="pmc_email" id="pmc_email" type="text" placeholder="<?php _e('Email Address', 'pmc'); ?>"/>
				</div>
				<div>
					<input type="hidden" name="redirect" value="<?php echo $redirect; ?>"/>
					<input type="hidden" name="action" value="pmc_signup"/>
					<input type="hidden" name="pmc_list_id" value="<?php echo $list_id; ?>"/>
					<input type="submit" value="<?php _e('Sign Up', 'pmc'); ?>"/>
				</div>
			</form>
			<?php
		}
	}
	return apply_filters('pmc_mc_form', ob_get_clean(), $redirect, $list_id, $message );
}

function pmc_mc_form_shortcode($atts, $content = null ) {

	global $pmc_options;

	extract( shortcode_atts( array(
		'redirect' => '',
		'list' => 1,
		'message' => __('You have been successfully subscribed.', 'pmc')
	), $atts ) );

	if($redirect == '') {
		$redirect = add_query_arg('submitted', 'yes', get_permalink());
	}

	$lists = pmc_get_lists();
	$i = 0;

	foreach($lists as $id => $list_name) {
		if($i == ($list-1) ) {
			$list_id = $id;
		}
		$i++;
	}

	return pmc_mc_form($redirect, $list_id, $message);
}
add_shortcode('mailchimp', 'pmc_mc_form_shortcode');