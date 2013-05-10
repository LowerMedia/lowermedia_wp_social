at <?php
/*
Plugin Name: LowerMedia WP Social
Plugin URI: http://lowermedia.net
Description: WordPress plugin that, when activated, creates a new widget area and new text widget for social media profiles.
Version: 1
Author: Pete Lower
Author URI: http://petelower.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*############################################################################################
#
#   REGISTER PLUGIN STYLES
#   //These functions enque and registers the plugin stylesheet
#	 //Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript (From Codex)
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
#   //This function adds information to the end of the post
*/

	function lowermedia_add_wp_social($output) {
			$output = dynamic_sidebar('lowermedia_wp_social_widget_area');
			return $output;
	}
	
	add_filter('wp_head', 'lowermedia_add_wp_social', 1000);//1000 is used to make sure this is loaded very lastly to the head


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
    $instance = wp_parse_args( 
    	(array) $instance, 
    	array( 
    		'margin_top_var' => '',
    		'margin_left_var' => '',
    		'opacity_var' => '',
    		'facebook' => '',
    		'twitter'=>'',
    		'youtube'=>'',
    		'linkedin' => '',
    		'googleplus'=>'',
    		'github'=>'',
    		'wordpress' => '',
    		'drupal'=>'',
    		'instagram' => '',
    		'pinterest'=>'',
    		'yelp'=>'' 
    	) 
    );
    
    $margin_top_var = $instance['margin_top_var'];
    $margin_left_var = $instance['margin_left_var'];
    $opacity_var = $instance['opacity_var'];
    $facebook = $instance['facebook'];
    $twitter = $instance['twitter'];
    $youtube = $instance['youtube'];
    $linkedin = $instance['linkedin'];
    $googleplus = $instance['googleplus'];
    $github = $instance['github'];
    $wordpress = $instance['wordpress'];
    $drupal = $instance['drupal'];
    $instagram = $instance['instagram'];
    $pinterest = $instance['pinterest'];
    $yelp = $instance['yelp'];

    //extract($instance);
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
	</label></br></br>
	<label for="<?php echo $this->get_field_id('margin_left_var'); ?>">
  		Add Left Margin: 	<br/>(px, em, %)<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('margin_left_var'); ?>" 
				  		name="<?php echo $this->get_field_name('margin_left_var'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($margin_left_var); ?>" 
			  		/>
	</label></br></br>
	<label for="<?php echo $this->get_field_id('opacity_var'); ?>">
  		Add Opacity: 	<br/>(.01-.9)<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('opacity_var'); ?>" 
				  		name="<?php echo $this->get_field_name('opacity_var'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($opacity_var); ?>" 
			  		/>
	</label></br></br>
  	<label for="<?php echo $this->get_field_id('facebook'); ?>">
  		Facebook Link: 	<br/>http://facebook.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('facebook'); ?>" 
				  		name="<?php echo $this->get_field_name('facebook'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($facebook); ?>" 
			  		/>
	</label></br></br>
	<label for="<?php echo $this->get_field_id('twitter'); ?>">
		Twitter Link: 	<br/>http://twitter.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('twitter'); ?>" 
				  		name="<?php echo $this->get_field_name('twitter'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($twitter); ?>" 
			  		/>
	</label><br/></br>
	<label for="<?php echo $this->get_field_id('youtube'); ?>">
		YouTube Link: 	<br/>http://youtube.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('youtube'); ?>" 
				  		name="<?php echo $this->get_field_name('youtube'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($youtube); ?>" 
			  		/>
	</label><br/></br>
	<label for="<?php echo $this->get_field_id('linkedin'); ?>">
		LinkedIn Link: 	<br/>http://linkedin.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('linkedin'); ?>" 
				  		name="<?php echo $this->get_field_name('linkedin'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($linkedin); ?>" 
			  		/>
	</label><br/></br>
	<label for="<?php echo $this->get_field_id('googleplus'); ?>">
		Google+ Link: 	<br/>http://plus.google.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('googleplus'); ?>" 
				  		name="<?php echo $this->get_field_name('googleplus'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($googleplus); ?>" 
			  		/>
  	</label><br/></br>
  	<label for="<?php echo $this->get_field_id('github'); ?>">
		GitHub Link: 	<br/>https://github.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('github'); ?>" 
				  		name="<?php echo $this->get_field_name('github'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($github); ?>" 
			  		/>
  	</label><br/></br>

  	<label for="<?php echo $this->get_field_id('wordpress'); ?>">
  		WordPress Link: 	<br/>http://profiles.wordpress.org/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('wordpress'); ?>" 
				  		name="<?php echo $this->get_field_name('wordpress'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($wordpress); ?>" 
			  		/>
	</label></br></br>
	<label for="<?php echo $this->get_field_id('drupal'); ?>">
		Drupal Link: 	<br/>http://drupal.org/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('drupal'); ?>" 
				  		name="<?php echo $this->get_field_name('drupal'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($drupal); ?>" 
			  		/>
	</label><br/></br>
	<label for="<?php echo $this->get_field_id('instagram'); ?>">
		Instagram Link: 	<br/>http://instagram.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('instagram'); ?>" 
				  		name="<?php echo $this->get_field_name('instagram'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($instagram); ?>" 
			  		/>
	</label><br/></br>
	<label for="<?php echo $this->get_field_id('pinterest'); ?>">
		Pinterest Link: 	<br/>http://pinterest.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('pinterest'); ?>" 
				  		name="<?php echo $this->get_field_name('pinterest'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($pinterest); ?>" 
			  		/>
  	</label><br/></br>
  	<label for="<?php echo $this->get_field_id('yelp'); ?>">
		Yelp Link: 	<br/>http://yelp.com/<input 
				  		class="widefat" 
				  		id="<?php echo $this->get_field_id('yelp'); ?>" 
				  		name="<?php echo $this->get_field_name('yelp'); ?>" 
				  		type="text" 
				  		value="<?php echo attribute_escape($yelp); ?>" 
			  		/>
  	</label><br/></br>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['margin_top_var'] = $new_instance['margin_top_var'];
    $instance['margin_left_var'] = $new_instance['margin_left_var'];
    $instance['opacity_var'] = $new_instance['opacity_var'];
    $instance['facebook'] = $new_instance['facebook'];
    $instance['twitter'] = $new_instance['twitter'];
    $instance['youtube'] = $new_instance['youtube'];
    $instance['linkedin'] = $new_instance['linkedin'];
    $instance['googleplus'] = $new_instance['googleplus'];
    $instance['github'] = $new_instance['github'];
    $instance['wordpress'] = $new_instance['wordpress'];
    $instance['drupal'] = $new_instance['drupal'];
    $instance['instagram'] = $new_instance['instagram'];
    $instance['pinterest'] = $new_instance['pinterest'];
    $instance['yelp'] = $new_instance['yelp'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;

	$margin_top_var = empty($instance['margin_top_var']) ? ' ' : apply_filters('widget_margin_top_var', $instance['margin_top_var']);
	$margin_left_var = empty($instance['margin_left_var']) ? ' ' : apply_filters('widget_margin_left_var', $instance['margin_left_var']);
	$opacity_var = empty($instance['opacity_var']) ? ' ' : apply_filters('widget_opacity_var', $instance['opacity_var']);

    $facebook = empty($instance['facebook']) ? ' ' : apply_filters('widget_facebook', $instance['facebook']);
    $facebook_link="'http://facebook.com/".$facebook."'";

    $twitter = empty($instance['twitter']) ? ' ' : apply_filters('widget_twitter', $instance['twitter']);
    $twitter_link="'http://twitter.com/".$twitter."'";

    $youtube = empty($instance['youtube']) ? ' ' : apply_filters('widget_youtube', $instance['youtube']);
    $youtube_link="'http://youtube.com/".$youtube."'";

    $linkedin = empty($instance['linkedin']) ? ' ' : apply_filters('widget_linkedin', $instance['linkedin']);
    $linkedin_link="'http://linkedin.com/".$linkedin."'";

    $googleplus = empty($instance['googleplus']) ? ' ' : apply_filters('widget_googleplus', $instance['googleplus']);
    $googleplus_link="'http://plus.google.com/".$googleplus."'";

    $github = empty($instance['github']) ? ' ' : apply_filters('widget_googleplus', $instance['github']);
    $github_link="'https://github.com/".$github."'";


    $wordpress = empty($instance['wordpress']) ? ' ' : apply_filters('widget_wordpress', $instance['wordpress']);
    $wordpress_link="'http://profiles.wordpress.org/".$wordpress."'";

    $drupal = empty($instance['drupal']) ? ' ' : apply_filters('widget_drupal', $instance['drupal']);
    $drupal_link="'http://drupal.org/".$drupal."'";

    $instagram = empty($instance['instagram']) ? ' ' : apply_filters('widget_instagram', $instance['instagram']);
    $instagram_link="'http://instagram.com/".$instagram."'";

    $pinterest = empty($instance['pinterest']) ? ' ' : apply_filters('widget_pinterest', $instance['pinterest']);
    $pinterest_link="'http://pinterest.com/".$pinterest."'";

    $yelp = empty($instance['yelp']) ? ' ' : apply_filters('widget_yelp', $instance['yelp']);
    $yelp_link="'http://yelp.com/".$yelp."'";
 

    // WIDGET CODE GOES HERE
    echo <<<EOT
	<section class="widget-1 widget-first widget social-icons" id="social-icons-widget-2" style="margin-top:$margin_top_var;margin-left:$margin_left_var;opacity:$opacity_var;">
	<div class="widget-inner" style="">
		<ul class="social-icons-list" style="">
EOT;

if (!empty($instance['facebook'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
			<li class="facebook" >
				<a href=$facebook_link >
					Facebook
				</a>
			</li>
EOT;
	}

if (!empty($instance['twitter'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
			<li class="twitter" >
				<a href=$twitter_link >
					Twitter
				</a>
			</li>
EOT;
	}

if (!empty($instance['youtube'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
			<li class="youtube" >
				<a href=$youtube_link >
					YouTube
				</a>
			</li>
EOT;
	}

if (!empty($instance['linkedin'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
		<li class="googleplus" >
			<a href=$googleplus_link  >
				Google+
			</a>
		</li>
EOT;
	}

if (!empty($instance['googleplus'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
		<li class="linkedin" >
			<a href=$linkedin_link >
				LinkedIn
			</a>
		</li>
EOT;
	}

if (!empty($instance['github'])) {
    //echo $before_facebook . $facebook . $after_facebook;;
		echo <<<EOT
		<li class="github" >
			<a href=$github_link >
				GitHub
			</a>
		</li>
EOT;
	}

if (!empty($instance['wordpress'])) {
    //echo $before_facebook . $wordpress . $after_facebook;;
		echo <<<EOT
			<li class="wordpress" >
				<a href=$wordpress_link >
					WordPress
				</a>
			</li>
EOT;
	}

if (!empty($instance['drupal'])) {
		echo <<<EOT
			<li class="drupal" >
				<a href=$drupal_link >
					Drupal
				</a>
			</li>
EOT;
	}

if (!empty($instance['instagram'])) {
		echo <<<EOT
		<li class="instagram" >
			<a href=$instagram_link  >
				Instagram
			</a>
		</li>
EOT;
	}

if (!empty($instance['pinterest'])) {
		echo <<<EOT
		<li class="pinterest" >
			<a href=$pinterest_link >
				Pinterest
			</a>
		</li>
EOT;
	}
if (!empty($instance['yelp'])) {
		echo <<<EOT
		<li class="yelp" >
			<a href=$yelp_link >
				Yelp
			</a>
		</li>
EOT;
	}
	echo "</ul></div></section>";
 
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("SocialMediaIcons");') );
?>