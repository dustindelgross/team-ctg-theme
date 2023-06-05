<?php
/**
 * @package TeamCTG
 * The parent theme functions are at /buddyboss-theme/inc/theme/functions.php
 */

/****************************** THEME SETUP ******************************/


define ('TEAMCTG_THEME_VERSION', '2.3.0');

/**
 * CB Hub Content
 * 
 * Filters the content for the Confetti Bits Hub page
 * so that users can experience the awesome power of
 * Confetti Bits.
 * 
 * @since Confetti_Bits 2.3.0
 * @see cb_member_template_part()
 * 
 */
function cb_hub_content() {
	if ( is_page('confetti-bits') ) {
		return cb_member_template_part();
	}
}
add_filter( 'the_content', 'cb_hub_content' );

/**
 * CB Theme Styles
 * 
 * Applies our styles to the theme.
 * All scripts (except for maybe one or two) are going to be 
 * loaded in the Confetti_Bits plugin.
 * 
 * @since Confetti_Bits 1.0.0
 * 
 */
function cb_theme_styles() {
	
	$directory_uri = get_stylesheet_directory_uri();

	wp_enqueue_style( 
		'cb-fonts',
		'https://use.typekit.net/tnv7tsi.css', 
		TEAMCTG_THEME_VERSION 
	);


	wp_enqueue_style( 
		'cb-type',
		"{$directory_uri}/assets/css/cb-type.css", 
		TEAMCTG_THEME_VERSION 
	);

	wp_enqueue_style( 
		'cb-hub-styles',
		"{$directory_uri}/assets/css/cb-hub.css",
		TEAMCTG_THEME_VERSION 
	);

	wp_enqueue_style( 
		'cb-form-styles',
		"{$directory_uri}/assets/css/cb-forms.css", 
		TEAMCTG_THEME_VERSION 
	);

	if ( cb_is_confetti_bits_component() && cb_is_user_participation_admin() ) {
		wp_enqueue_style( 
			'cb-hub-admin-styles',
			"{$directory_uri}/assets/css/cb-hub-admin.css", 
			TEAMCTG_THEME_VERSION 
		);
	}
}
add_action( 'cb_enqueue_scripts', 'cb_theme_styles', 999 );


function confettify_the_login () {


	wp_enqueue_style( 
		'cb-fonts',
		'https://use.typekit.net/tnv7tsi.css', 
		TEAMCTG_THEME_VERSION 
	);

	wp_enqueue_style( 
		'teamctg-login', 
		get_stylesheet_directory_uri().
		'/assets/css/login-type.css',
		TEAMCTG_THEME_VERSION, 
		'all'
	);

}


//add_action( 'login_enqueue_scripts', 'confettify_the_login', 15 );

//add_action('wp_head', 'get_the_fonts');



function cb_profile_nav_link() { ?>
<li id="confetti-bits-personal-li" class="bp-personal-tab">
	<a href="<?php echo bp_displayed_user_domain() . "confetti-bits"; ?>" id="user-confetti-bits">
		<div class="bb-single-nav-item-point">Confetti Bits</div>
	</a>
</li><?php }

function is_this_dustin() {
	$current_person = get_current_user_id();
	if ( $current_person === 1 ) {
		return true;
	} else {
		return false;
	}
}

function is_this_admins() {
	$current_person = get_current_user_id();
	if ( $current_person === 76 || $current_person === 4 ) {
		return true;
	} else {
		return false;
	}
}

function tctg_sender_email( $original_email_address ) {
	return 'dustin@mail.teamctg.com';
}
function tctg_sender_name( $original_email_from ) {
	return 'TeamCTG';
}
add_filter( 'wp_mail_from', 'tctg_sender_email' );
add_filter( 'wp_mail_from_name', 'tctg_sender_name' );

add_action( 'phpmailer_init', 'tctg_smtp_init' );
function tctg_smtp_init( $phpmailer ) {
	$phpmailer->Host		= SMTP_HOST;
	$phpmailer->Port		= SMTP_PORT;
	$phpmailer->Username	= SMTP_USER;
	$phpmailer->Password	= SMTP_PASS;
	$phpmailer->From		= SMTP_FROM;
	$phpmailer->FromName	= SMTP_NAME;
	$phpmailer->SMTPAuth	= true;
	$phpmailer->SMTPSecure = SMTP_SECURE;

	$phpmailer->IsSMTP();

}

add_filter( 'buddyboss_theme_redux_is_theme', '__return_true', 999 );

/**
 * Get path from template directory to current file.
 * 
 * 
 * @param string $file_path Current file path
 * 
 * @uses get_template() Get active template directory name.
 * 
 * @return string
 */

function buddyboss_theme_dir_to_current_file_path( $file_path ) {
	// Format current file path with only right slash.
	$file_path = trailingslashit( $file_path );
	$file_path = str_replace( '\\', '/', $file_path );
	$file_path = str_replace( '//', '/', $file_path );
	$chunks    = explode( '/', $file_path );
	if ( ! is_array( $chunks ) ) {
		$chunks = array();
	}
	// Reverse array for child to parent or current file to template directory.
	$chunks   = array_reverse( $chunks );
	$template = get_template();
	$tmp_file = array();
	foreach ( $chunks as $path ) {
		if ( empty( $path ) ) {
			continue;
		}
		if ( $path == $template ) {
			break;
		}
		// Set all directory name from current file to template directory.
		$tmp_file[] = $path;              
	}
	// Reverse array for parent to child or template directory to file directory.
	$tmp_file = array_reverse( $tmp_file );
	$tmp_file = implode( '/', $tmp_file );
	return $tmp_file;
}

/**
 * Filter Redux URL
 * 
 * @param string $url Redux url.
 * 
 * @uses buddyboss_theme_dir_to_current_file_path() Get relative path.
 * 
 * @return string
 */
function buddyboss_theme_redux_url( $url ) { 
	/**
     * When some parts of current file path and template directory path are match from the beginning.
     * 
     * Example
     * current_path = /bitnami/wordpress/wp-content/
     * tmpdir_path  = /bitnami/wordpress/wp-content/themes/buddyboss-theme/inc/admin/framework/ReduxCore/
     */
	if ( strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( get_template_directory() ) ) !== false ) {
		return $url;
	} else if ( strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( get_stylesheet_directory() ) ) !== false ) {
		return $url;
	} 
	/**
     * When some parts of current file path and template directory path are not match from the beginning.
     * 
     * Example
     * current_path = /opt/bitnami/wordpress/wp-content/
     * tmpdir_path  = /bitnami/wordpress/wp-content/themes/buddyboss-theme/inc/admin/framework/ReduxCore/
     */
	// Get template url.
	$tem_dir  = trailingslashit( get_template_directory_uri() );
	// Get template to current file directory path.
	$file_dir = buddyboss_theme_dir_to_current_file_path( $url );
	// Set url for ReduxCore directory
	$redux_url = trailingslashit( $tem_dir . $file_dir );
	// Check valid url
	if ( filter_var ( $redux_url, FILTER_VALIDATE_URL ) ) {
		return $redux_url;
	} 
	return $url;
}
add_filter( 'redux/_url', 'buddyboss_theme_redux_url' );

add_filter( 'style_loader_src', 'bb_fix_theme_option_for_custom_wp_installation' );
add_filter( 'script_loader_src', 'bb_fix_theme_option_for_custom_wp_installation' );
function bb_fix_theme_option_for_custom_wp_installation( $url ) {
	if ( is_admin() ) {
		$url = str_replace( 'plugins/bitnami/wordpress/wp-content/themes/buddyboss-theme/', 'themes/buddyboss-theme/', $url );
	}
	return $url;
}

function cb_temp_culture_calendar_content() {
	if ( is_page('events') ) {
		echo "<script src='https://events.timely.fun/embed.js' data-src='https://events.timely.fun/cp3goaa2/' data-max-height='0'  id='timely_script' class='timely-script'></script>";		
	}
}
add_filter( 'the_content', 'cb_temp_culture_calendar_content' );