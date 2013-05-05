<?php
/*
Plugin Name: LowerMedia WP Social
Plugin URI: http://lowermedia.net
Description: WordPress plugin that, when activated, creates a new widget area and new text widget for social media profiles.
Version: .8
Author: Pete Lower
Author URI: http://petelower.com
License: A "Slug" license name e.g. GPL2
*/

/*############################################################################################
#
#   REGISTER PLUGIN STYLES
#   //These functions enques and registers the plugin stylesheet
*/

/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'lowermedia_add_my_stylesheet' );

/**
 * Enqueue plugin style-file
 */
function lowermedia_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'lowermedia-style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'lowermedia-style' );
}

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

add_filter('wp_head', 'lowermedia_add_wp_social', 1000);//1000 is there to make sure this is loaded very lastly to the head


/*############################################################################################
#
#   ADD POST CONTENT
#   //This function adds information to the end of the post,,,,,  && !is_home()
*/

class SocialMediaIcons extends WP_Widget
{
  function SocialMediaIcons()
  {
    $widget_ops = array('classname' => 'SocialMediaIcons', 'description' => 'Displays Social Media Icons' );
    $this->WP_Widget('SocialMediaIcons', 'Social Media Icons', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'margin_top_var' => '','facebook' => '', 'twitter'=>'', 'linkedin' => '', 'googleplus'=>'' ) );
    
    $margin_top_var = $instance['margin_top_var'];
    $facebook = $instance['facebook'];
    $twitter = $instance['twitter'];
    $linkedin = $instance['linkedin'];
    $googleplus = $instance['googleplus'];
?>
  <p>
  	<label for="<?php echo $this->get_field_id('margin_top_var'); ?>">
  		Add Top Margin: 	<br/>(px, em, %)<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('margin_top_var'); ?>" 
				  		name="<?php echo $this->get_field_name('margin_top_var'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($margin_top_var); ?>" 
			  		/>
	</label></br>
  	<label for="<?php echo $this->get_field_id('facebook'); ?>">
  		Facebook Link: 	<br/>http://facebook.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('facebook'); ?>" 
				  		name="<?php echo $this->get_field_name('facebook'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($facebook); ?>" 
			  		/>
	</label></br>
	<label for="<?php echo $this->get_field_id('twitter'); ?>">
		Twitter Link: 	<br/>http://twitter.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('twitter'); ?>" 
				  		name="<?php echo $this->get_field_name('twitter'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($twitter); ?>" 
			  		/>
	</label><br/>
	<label for="<?php echo $this->get_field_id('linkedin'); ?>">
		LinkedIn Link: 	<br/>http://linkedin.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('linkedin'); ?>" 
				  		name="<?php echo $this->get_field_name('linkedin'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($linkedin); ?>" 
			  		/>
	</label><br/>
	<label for="<?php echo $this->get_field_id('googleplus'); ?>">
		Google+ Link: 	<br/>http://plus.google.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('googleplus'); ?>" 
				  		name="<?php echo $this->get_field_name('googleplus'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($googleplus); ?>" 
			  		/>
  	</label><br/>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['margin_top_var'] = $new_instance['margin_top_var'];
    $instance['facebook'] = $new_instance['facebook'];
    $instance['twitter'] = $new_instance['twitter'];
    $instance['linkedin'] = $new_instance['linkedin'];
    $instance['googleplus'] = $new_instance['googleplus'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $facebook = empty($instance['facebook']) ? ' ' : apply_filters('widget_facebook', $instance['facebook']);
    $facebook_link="'http://facebook.com/".$facebook."'";

    $twitter = empty($instance['twitter']) ? ' ' : apply_filters('widget_twitter', $instance['twitter']);
    $twitter_link="'http://twitter.com/".$twitter."'";

    $linkedin = empty($instance['linkedin']) ? ' ' : apply_filters('widget_linkedin', $instance['linkedin']);
    $linkedin_link="'http://linkedin.com/".$linkedin."'";

    $googleplus = empty($instance['googleplus']) ? ' ' : apply_filters('widget_googleplus', $instance['googleplus']);
    $googleplus_link="'http://plus.google.com/".$googleplus."'";
 

    // WIDGET CODE GOES HERE
    echo <<<EOT
	<section class="widget-1 widget-first widget social-icons" id="social-icons-widget-2" style="margin-top:$margin_top_var">
	<div class="widget-inner" style="">
		<ul class="social-icons-list" style="">
EOT;

if (!empty($instance['facebook'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
			<li class="facebook" style="">
				<a href=$facebook_link style="width: 30px; position: absolute; font-size: 0px; height: 31px;">
					Facebook
				</a>
			</li>
EOT;
	}

if (!empty($instance['twitter'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
			<li class="twitter" style="">
				<a href=$twitter_link style="width: 30px; position: absolute; font-size: 0px; height: 31px;" >
					Twitter
				</a>
			</li>
EOT;
	}

if (!empty($instance['linkedin'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
		<li class="googleplus" style="">
			<a href=$googleplus_link  style="width: 30px; position: absolute; font-size: 0px; height: 31px;">
				Google+
			</a>
		</li>
EOT;
	}

if (!empty($instance['googleplus'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
		<li class="linkedin" style="">
			<a href=$linkedin_link  style="width: 30px; position: absolute; font-size: 0px; height: 31px;">
				LinkedIn
			</a>
		</li>
EOT;

	echo "</ul></div></section>";

	}
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SocialMediaIcons");') );

?>