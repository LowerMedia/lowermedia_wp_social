<?php
/*
Plugin Name: LowerMedia WP Social
Plugin URI: http://lowermedia.net
Description: WordPress plugin that, when activated, creates a new widget area and new text widget for social media profiles.
Version: .4
Author: Pete Lower
Author URI: http://petelower.com
License: A "Slug" license name e.g. GPL2
*/

/*############################################################################################
#
#   REGISTER WDIGETS
#   //This function creates and registers the social media icon holder widget
*/
function lowermedia_wp_social_init() {
    register_sidebar( array(
		'name' => 'Social Media Area',
		'id' => 'lowermedia_wp_social_widget_area',
		'before_widget' => '<div id="lowermedia-wp-social-wrap" style="position:fixed;">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action('widgets_init', 'lowermedia_wp_social_init');


/*############################################################################################
#
#   ADD POST CONTENT
#   //This function adds information to the end of the post,,,,,  && !is_home()
*/

function lowermedia_add_wp_social($output) {
		$output = dynamic_sidebar('lowermedia_wp_social_widget_area');
		return $output;
}

add_filter('wp_head', 'lowermedia_add_wp_social', 1000);


/*############################################################################################
#
#   ADD POST CONTENT
#   //This function adds information to the end of the post,,,,,  && !is_home()
*/
// class lowermedia_wp_social extends WP_Widget {
//         public function __construct() {
// 			// widget actual processes
// 			parent::WP_Widget(false,"LowerMedia WP Social Widget","description=Social Media Icon Holder Widget");
// 		}

//         public function form( $instance ) {
//                // outputs the options form on admin
//         	echo "Enter Social Media Links";
//         }

//         public function update( $new_instance, $old_instance ) {
//                // processes widget options to be saved
//         }

//         public function widget( $args, $instance ) {
//                // outputs the content of the widget
//         }

// }
// register_widget( 'lowermedia_wp_social' );

?>