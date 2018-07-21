<?php
/**
 * Plugin Name: Eyemax Custom Analytics
 * Plugin URI: https://github.com/alexmoise/eyemax-analytics
 * GitHub Plugin URI: https://github.com/alexmoise/eyemax-analytics
 * Description: A custom plugin to insert Google Analytics code and send some custom events.
 * Version: 0.1.9
 * Author: Alex Moise
 * Author URI: https://moise.pro
 */

if ( ! defined( 'ABSPATH' ) ) {	exit(0);}

// output the Google Analytics JS tracking code
function moeyemx_analytics_code() {
	$moeyemx_tracking_id = strip_tags(get_option( 'moeyemx_ua_code' ));
	$output_moeyemx_analytics_code="
		<!-- Google Analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '".$moeyemx_tracking_id."', 'auto');
		ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->
	";
	echo $output_moeyemx_analytics_code;
}
add_action('wp_head','moeyemx_analytics_code');

// Adding own JS
function moeyemx_adding_script() {
	wp_register_script('moeyemx-script', plugins_url('eyemax-analytics.js', __FILE__), array('jquery'), '', true);
	wp_enqueue_script('moeyemx-script');
}
add_action( 'wp_enqueue_scripts', 'moeyemx_adding_script', 1 ); 

// === Add plugin's admin options ===
// Create its settings menu
add_action('admin_menu', 'moeyemx_create_menu');
function moeyemx_create_menu() {
	//create Settings menu item
	add_options_page('Eyemax Analytics options page', 'Eyemax Analytics', 'manage_options', 'moeyemx-options', 'moeyemx_options_management' );
	//call register settings function
	add_action( 'admin_init', 'moeyemx_register_settings' );
}
// Register its settings
function moeyemx_register_settings() {
	register_setting( 'moeyemx-settings-group', 'moeyemx_ua_code' );
	register_setting( 'moeyemx-settings-group', 'moeyemx_display_first_settings_notice' );
	register_setting( 'moeyemx-settings-group', 'moeyemx_delete_options_uninstall' );
}
// Show an sdmin notice inviting to plugin's settings
add_action( 'admin_notices', 'moeyemx_first_settings_notice' );
function moeyemx_first_settings_notice() {
	if ( get_option ( 'moeyemx_display_first_settings_notice' ) != 1 )  {
		echo "<div class=\"notice-info notice\"><p><strong>Eyemax Analytics</strong> plugin is installed and activated. Now go to <a href=\"".get_site_url()."/wp-admin/options-general.php?page=moeyemx-options\">its Settings page</a> page and insert <em><strong>the UA Tracking ID</strong></em> from your Google Analytics account. This notice will be automatically dismissed after first saving the <strong>Eyemax Analytics</strong> plugin options.</p></div>";
	}
}
// Setting management page in WP-Admin section:
function moeyemx_options_management() {
?>
<div class="wrap">
<h1>Settings for <strong>Eyemax Analytics</strong> plugin</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'moeyemx-settings-group' ); ?>
    <?php do_settings_sections( 'moeyemx-settings-group' ); ?>

	<p>Please visit your <a href="https://analytics.google.com/analytics/web/" target="_blank">Google Analytics console</a>, grab your Tracking ID and insert it below! </p>
	
	<input name="moeyemx_display_first_settings_notice" type="hidden" value="1" <?php echo esc_attr( get_option('moeyemx_display_first_settings_notice', '1') ); ?> />
	
	<table class="form-table">
		<tr valign="top">
			<th scope="row">"UA" Tracking ID: </th>
			<td> 
				<input name="moeyemx_ua_code" type="text" id="moeyemx_ua_code" aria-describedby="moeyemx_ua_code" value="<?php echo strip_tags(get_option( 'moeyemx_ua_code' )); ?>" class="regular-text">
				<span>(In the "UA-XXXXXXX-Y" format.)</span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Delete this plugin options from database on uninstall: </th>
			<td>
				<input name="moeyemx_delete_options_uninstall" type="checkbox" value="1" <?php checked( '1', get_option( 'moeyemx_delete_options_uninstall' ) ); ?> />
				<span>(Otherwise they'll stay there in case the plugin gets reinstalled later - useful for updating)</span>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>
</form>
</div>
<?php }
?>
