<?php
/**
 * Plugin Name: Eyemax Custom Analytics
 * Plugin URI: https://github.com/alexmoise/eyemax-analytics
 * GitHub Plugin URI: https://github.com/alexmoise/eyemax-analytics
 * Description: A custom plugin to insert Google Analytics code and send some custom events.
 * Version: 0.0.1
 * Author: Alex Moise
 * Author URI: https://moise.pro
 */

if ( ! defined( 'ABSPATH' ) ) {	exit(0);}

//
function moeyemx_analytics_code() {
    $output_moeyemx_analytics_code="
		<!-- Google Analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-xxxxxxxxx-y', 'auto');
		ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->
	";

    echo $output_moeyemx_analytics_code;
}
add_action('wp_head','moeyemx_analytics_code');



// Adding own JS
function moeyemx_adding_script() {
	wp_register_script('moeyemx-script', plugins_url('moeyemx.js', __FILE__), array('jquery'), '', true);
	wp_enqueue_script('moeyemx-script');
}
add_action( 'wp_enqueue_scripts', 'moeyemx_adding_script', 1 ); 
?>
