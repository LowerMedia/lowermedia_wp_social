<?php
/*
Plugin Name: LowerMedia WP Social
Plugin URI: http://lowermedia.net
Description: Social Media Toolbar Made Easy! Creates widget and widget area to display social media profile links at the top or left of your website.
Version: 2.0.3
Stable: 2.0.3
Author: Pete Lower
Author URI: http://petelower.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*############################################################################################
#
#   ADD ADMIN MENU
#   //
#	//
*/

class lowermedia_wp_social_admin {
    public function __construct(){
        if(is_admin()){
	    	add_action('admin_menu', array($this, 'lmwps_options_page'));
	    	add_action('admin_init', array($this, 'page_init'));
		}
    }
	
    public function lmwps_options_page(){
        // This page will be under "Settings"
		add_menu_page('LowerMeida WP Social Options', 'WP Social Options', 'manage_options', 'lmwps-admin-options', array($this, 'lmwps_options'));
    }

    public function lmwps_options(){
        ?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Settings</h2>			
	    <form method="post" action="options.php">
	        <?php
                    // This prints out all hidden setting fields
		    settings_fields('lowermedia_wps_option_group');	
		    do_settings_sections('lmwps-admin-options');
		?>
	        <?php submit_button(); ?>
	    </form>
	</div>
	<?php
    }
	
    public function page_init(){		
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_enable', array($this, 'check_enable'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_rounded', array($this, 'check_rounded'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_bkgrnd', array($this, 'check_bkgrnd'));
		//register_setting('lowermedia_wps_option_group', '{NAME HERE}', array($this, 'check_{FUNCTION NAME HERE}'));
		//$rounded_corners_var = $instance['rounded_corners_var'];



        add_settings_section(
		    'lmwps_wps_enable',
		    '<!-- Check Box -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);	

		add_settings_section(
		    'lmwps_wps_rounded',
		    '<!-- Check Box -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);	

		add_settings_section(
		    'lmwps_wps_bkgrnd',
		    '<!-- Check Box -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);	
		
		add_settings_field(
		    'lmwps_enable', 
		    'Check to enable the WP Social Sidebar', 
		    array($this, 'lmwps_enable'), 
		    'lmwps-admin-options',
		    'lmwps_wps_enable'			
		);	

		add_settings_field(
		    'lmwps_rounded', 
		    'Rounded social media icons?', 
		    array($this, 'lmwps_rounded'), 
		    'lmwps-admin-options',
		    'lmwps_wps_rounded'			
		);

		add_settings_field(
		    'lmwps_bkgrnd', 
		    'Background?', 
		    array($this, 'lmwps_bkgrnd'), 
		    'lmwps-admin-options',
		    'lmwps_wps_bkgrnd'			
		);	

		// add_settings_field(
		//     'lmopt_test', 
		//     '{QUESTION HERE}', 
		//     array($this, 'lmopt_{FUNCTION NAME HERE}'), 
		//     'lmwps-admin-options',
		//     '{NAME HERE}'			
		// );	
    }

    function check_enable($input){

 		$output = $input['lmwps_enable'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_enable'])) {
		    if(get_option('lmwps_enable_option') === FALSE){
				add_option('lmwps_enable_option', $output);
		    }else{
				update_option('lmwps_enable_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_enable_option');
		}
		return $output;
    }

    function check_rounded($input){

 		$output = $input['lmwps_rounded'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_rounded'])) {
		    if(get_option('lmwps_rounded_option') === FALSE){
				add_option('lmwps_rounded_option', $output);
		    }else{
				update_option('lmwps_rounded_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_rounded_option');
		}
		return $output;
    }

    function check_bkgrnd($input){

 		$output = $input['lmwps_bkgrnd'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_bkgrnd'])) {
		    if(get_option('lmwps_bkgrnd_option') === FALSE){
				add_option('lmwps_bkgrnd_option', $output);
		    }else{
				update_option('lmwps_bkgrnd_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_bkgrnd_option');
		}
		return $output;
    }
	

    function lmwps_enable(){
        ?>
	        <input 
		        type="checkbox" 
		        id="lmwps_enable" 
		        name="lmwps_wps_enable[lmwps_enable]" 
		        value="1" 
		        <?php 
		        if ( get_option('lmwps_enable_option') ) {echo 'checked="checked"'; }
	    ?> /><?php
	}

    function lmwps_rounded(){
        ?>
	        <input 
		        type="checkbox" 
		        id="lmwps_rounded" 
		        name="lmwps_wps_rounded[lmwps_rounded]" 
		        value="1" 
		        <?php if ( get_option('lmwps_rounded_option') ) {echo 'checked="checked"'; } ?> 
	    	/>
	    <?php

    }

    function lmwps_bkgrnd(){
        ?>
	        <input 
		        type="checkbox" 
		        id="lmwps_bkgrnd" 
		        name="lmwps_wps_bkgrnd[lmwps_bkgrnd]" 
		        value="1" 
		        <?php if ( get_option('lmwps_bkgrnd_option') ) {echo 'checked="checked"'; } ?> 
	    	/>
	    <?php

    }

    function print_section_info(){//CALLBACK FUNCTION
		print '<!-- Enter your setting below:-->';
    }
}

$lowermedia_wp_social_admin = new lowermedia_wp_social_admin();

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
#   REGISTER SIDEBAR AREA FOR WIDGET
#   //This function creates and registers the social media icon holder widget
*/
	function lowermedia_wp_social_init() {
	    register_sidebar( array(
			'name' => 'Social Media Area',
			'id' => 'lowermedia_wp_social_widget_area',
			'before_widget' => '<div id="lowermedia-wp-social-wrap">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="rounded">',
			'after_title' => '</h2>',
		) );
	}
	add_action('widgets_init', 'lowermedia_wp_social_init');


/*############################################################################################
#
#   ADD WIDGET AREA OUTPUT TO THE END OF THE WP_HEAD (BEGINING OF BODY TAG)
#   //This function adds to the begining of the body tag
*/	

	function lowermedia_add_wp_social($output) {
		
		
		if (get_option('lmwps_rounded_option')){
			$GLOBALS['css_class_var_rounded'] = " lm-wps-rounded ";
		}
		if (get_option('lmwps_bkgrnd_option')){
			$GLOBALS['css_class_var_bkgrnd']  == 1 ? $css_class_var_bkgrnd = " lm-wps-bkgrnd " : "";
		}

		if ( get_option('lmwps_enable_option')) {
			$output = dynamic_sidebar('lowermedia_wp_social_widget_area');
		}
		return $output;
	}
	add_filter('wp_head', 'lowermedia_add_wp_social', 1000);//1000 is used to make sure this is loaded very lastly to the head


/*############################################################################################
#
#   CREATE SOCIALMEDIAICONS CLASS THAT EXTENDS WP_WIDGET
#   
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
		$instance = wp_parse_args
		( 
			(array) $instance, 
			array( 
				'margin_top_var' => '',
				'margin_left_var' => '',
				'default_bkgrnd_var' => '',
				'rounded_corders_var' => '',
				'position_var' => '',
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
				'email'=>'',
				'rss'=>'',
				'soundcloud' => '',
				'blogger'=>'',
				'reverbnation' => '',
				'bandcamp'=>''
			)
		);
    
	    $margin_top_var = $instance['margin_top_var'];
	    $margin_left_var = $instance['margin_left_var'];
	    $default_bkgrnd_var = $instance['default_bkgrnd_var'];
	    $rounded_corners_var = $instance['rounded_corners_var'];
	    $position_var = $instance['position_var'];
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
	    
	    $email = $instance['email'];
	    $rss = $instance['rss'];
	    $soundcloud = $instance['soundcloud'];
	    $blogger = $instance['blogger'];
	    $reverbnation = $instance['reverbnation'];
	    $bandcamp = $instance['bandcamp'];

    //extract($instance);
	?>
  <p>
  	<hr /></br><center><strong>ADD STYLE INFO BELOW</strong></center></br><hr />
	  	
	  	<label for="<?php echo $this->get_field_id('margin_top_var'); ?>">
	  		Add Top Margin: 	<br/>(px, em, %)<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('margin_top_var'); ?>" 
					  		name="<?php echo $this->get_field_name('margin_top_var'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($margin_top_var); ?>" 
				  		/>
		</label></br></br>
		<label for="<?php echo $this->get_field_id('margin_left_var'); ?>">
	  		Add Left Padding: 	<br/>(px, em, %)<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('margin_left_var'); ?>" 
					  		name="<?php echo $this->get_field_name('margin_left_var'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($margin_left_var); ?>" 
				  		/>
		</label></br></br>
		<label for="<?php echo $this->get_field_id('position_var'); ?>">
	  		Position: 	<br/>(top or side)<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('position_var'); ?>" 
					  		name="<?php echo $this->get_field_name('position_var'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($position_var); ?>" 
				  		/>
		</label></br></br>
		<label for="<?php echo $this->get_field_id('opacity_var'); ?>">
	  		Add Opacity: 	<br/>(.01-.9)<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('opacity_var'); ?>" 
					  		name="<?php echo $this->get_field_name('opacity_var'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($opacity_var); ?>" 
				  		/>
		</label></br><br/>

	<label for="<?php echo $this->get_field_id('default_bkgrnd_var'); ?>">
		<?php _e('Check For Background Styling:'); ?>
		<input 
			id="<?php echo $this->get_field_id('default_bkgrnd_var'); ?>"
			name="<?php echo $this->get_field_name('default_bkgrnd_var'); ?>"
			type="checkbox" 
			value="1" 
			<?php if ( $instance['default_bkgrnd_var'] ) echo 'checked="checked"'; ?>
		/>
	</label>

	<label for="<?php echo $this->get_field_id('rounded_corners_var'); ?>">
		<?php _e('Check For Rounded Corners:'); ?>
		<input 
			id="<?php echo $this->get_field_id('rounded_corners_var'); ?>"
			name="<?php echo $this->get_field_name('rounded_corners_var'); ?>"
			type="checkbox" 
			value="1" 
			<?php if ( $instance['rounded_corners_var'] ) echo 'checked="checked"'; ?>
		/>
	</label>

	<hr /></br><strong><center>ADD LINK INFO BELOW</strong></center></br><hr /></br>
  	
	  	<label for="<?php echo $this->get_field_id('facebook'); ?>">
	  		Facebook Link: 	<br/>http://facebook.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('facebook'); ?>" 
					  		name="<?php echo $this->get_field_name('facebook'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($facebook); ?>" 
				  		/>
		</label></br></br>
		<label for="<?php echo $this->get_field_id('twitter'); ?>">
			Twitter Link: 	<br/>http://twitter.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('twitter'); ?>" 
					  		name="<?php echo $this->get_field_name('twitter'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($twitter); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('youtube'); ?>">
			YouTube Link: 	<br/>http://youtube.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('youtube'); ?>" 
					  		name="<?php echo $this->get_field_name('youtube'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($youtube); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('linkedin'); ?>">
			LinkedIn Link: 	<br/>http://linkedin.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('linkedin'); ?>" 
					  		name="<?php echo $this->get_field_name('linkedin'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($linkedin); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('googleplus'); ?>">
			Google+ Link: 	<br/>http://plus.google.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('googleplus'); ?>" 
					  		name="<?php echo $this->get_field_name('googleplus'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($googleplus); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('github'); ?>">
			GitHub Link: 	<br/>https://github.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('github'); ?>" 
					  		name="<?php echo $this->get_field_name('github'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($github); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('wordpress'); ?>">
	  		WordPress Link: 	<br/>http://profiles.wordpress.org/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('wordpress'); ?>" 
					  		name="<?php echo $this->get_field_name('wordpress'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($wordpress); ?>" 
				  		/>
		</label></br></br>
		<label for="<?php echo $this->get_field_id('drupal'); ?>">
			Drupal Link: 	<br/>http://drupal.org/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('drupal'); ?>" 
					  		name="<?php echo $this->get_field_name('drupal'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($drupal); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('instagram'); ?>">
			Instagram Link: 	<br/>http://instagram.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('instagram'); ?>" 
					  		name="<?php echo $this->get_field_name('instagram'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($instagram); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('pinterest'); ?>">
			Pinterest Link: 	<br/>http://pinterest.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('pinterest'); ?>" 
					  		name="<?php echo $this->get_field_name('pinterest'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($pinterest); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('yelp'); ?>">
			Yelp Link: 	<br/>http://yelp.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('yelp'); ?>" 
					  		name="<?php echo $this->get_field_name('yelp'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($yelp); ?>" 
				  		/>
	  	</label><br/></br>
	  	
	  	<label for="<?php echo $this->get_field_id('email'); ?>">
			Email Link: 	<br/>(Provide Email Address)<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('email'); ?>" 
					  		name="<?php echo $this->get_field_name('email'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($email); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('rss'); ?>">
	  		RSS Link: 	<br/>(Provide Full Link)<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('rss'); ?>" 
					  		name="<?php echo $this->get_field_name('rss'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($rss); ?>" 
				  		/>
		</label></br></br>
		<label for="<?php echo $this->get_field_id('soundcloud'); ?>">
			SoundCloud Link: 	<br/>https://soundcloud.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('soundcloud'); ?>" 
					  		name="<?php echo $this->get_field_name('soundcloud'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($soundcloud); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('blogger'); ?>">
			Blogger Link: 	<br/>http://{yourchosenname}.blogspot.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('blogger'); ?>" 
					  		name="<?php echo $this->get_field_name('blogger'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($blogger); ?>" 
				  		/>
		</label><br/></br>
		<label for="<?php echo $this->get_field_id('reverbnation'); ?>">
			Reverbnation Link: 	<br/>http://reverbnation.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('reverbnation'); ?>" 
					  		name="<?php echo $this->get_field_name('reverbnation'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($reverbnation); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('bandcamp'); ?>">
			BandCamp Link: 	<br/>http://{yourchosenname}.bandcamp.com/<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('bandcamp'); ?>" 
					  		name="<?php echo $this->get_field_name('bandcamp'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($bandcamp); ?>" 
				  		/>
	  	</label><br/></br>
  </p>
	<?php
}
 
	function update($new_instance, $old_instance)
		{
			//strip tags for security
			$instance = $old_instance;
			$instance['margin_top_var'] = strip_tags($new_instance['margin_top_var']);
			$instance['margin_left_var'] = strip_tags($new_instance['margin_left_var']);
			$instance['default_bkgrnd_var'] = strip_tags($new_instance['default_bkgrnd_var']);
			$instance['rounded_corners_var'] = strip_tags($new_instance['rounded_corners_var']);
			$instance['position_var'] = strip_tags($new_instance['position_var']);
			$instance['opacity_var'] = strip_tags($new_instance['opacity_var']);
			$instance['facebook'] = strip_tags($new_instance['facebook']);
			$instance['twitter'] = strip_tags($new_instance['twitter']);
			$instance['youtube'] = strip_tags($new_instance['youtube']);
			$instance['linkedin'] = strip_tags($new_instance['linkedin']);
			$instance['googleplus'] = strip_tags($new_instance['googleplus']);
			$instance['github'] = strip_tags($new_instance['github']);
			$instance['wordpress'] = strip_tags($new_instance['wordpress']);
			$instance['drupal'] = strip_tags($new_instance['drupal']);
			$instance['instagram'] = strip_tags($new_instance['instagram']);
			$instance['pinterest'] = strip_tags($new_instance['pinterest']);
			$instance['yelp'] = strip_tags($new_instance['yelp']);
			$instance['email'] = strip_tags($new_instance['email']);
			$instance['rss'] = strip_tags($new_instance['rss']);
			$instance['soundcloud'] = strip_tags($new_instance['soundcloud']);
			$instance['blogger'] = strip_tags($new_instance['blogger']);
			$instance['reverbnation'] = strip_tags($new_instance['reverbnation']);
			$instance['bandcamp'] = strip_tags($new_instance['bandcamp']);
			return $instance;
		}
 
  function widget($args, $instance)
	{
	extract($args, EXTR_SKIP);

	echo $before_widget;

	//Format Style Variables
	$margin_top_var = empty($instance['margin_top_var']) ? ' ' : apply_filters('widget_margin_top_var', $instance['margin_top_var']);
	$margin_left_var = empty($instance['margin_left_var']) ? ' ' : apply_filters('widget_margin_left_var', $instance['margin_left_var']);
	//$default_bkgrnd_var = empty($instance['default_bkgrnd_var']) ? ' ' : apply_filters('widget_default_bkgrnd_var', $instance['default_bkgrnd_var']);
	//$rounded_corners_var = empty($instance['rounded_corners_var']) ? ' ' : apply_filters('widget_rounded_corners_var', $instance['rounded_corners_var']);
	$position_var = empty($instance['position_var']) ? ' ' : apply_filters('widget_position_var', $instance['position_var']);
	$opacity_var = empty($instance['opacity_var']) ? ' ' : apply_filters('widget_opacity_var', $instance['opacity_var']);

	//Ternary statements to assign css classes to html tags in output, background styles, sections styles (top or side), and ul styles inline/margins
	//$css_class_var_bkgrnd = $default_bkgrnd_var == 1 ? $css_class_var_bkgrnd = " lm-wps-bkgrnd " : "";
	// $css_class_var_rounded = $rounded_corners_var == 1 ? $css_class_var_rounded = " lm-wps-rounded " : "";
	$css_class_var_section = $position_var == "top" ? $css_class_var_section = " lm-wps-top " : " lm-wps-side ";
	$css_class_var_ul = $position_var == "top" ? $css_class_var_ul = " lm-wps-top-ul " : " lm-wps-side-ul ";
	
	$css_class_holder = $GLOBALS['css_class_var_bkgrnd']." ".$GLOBALS['css_class_var_rounded']." ".$css_class_var_section." ".$css_class_var_ul;

	//Icon Variables
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

	$github = empty($instance['github']) ? ' ' : apply_filters('widget_github', $instance['github']);
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

	$email = empty($instance['email']) ? ' ' : apply_filters('widget_email', $instance['email']);
	$email_link="'mailto:".$email."'";

	$rss = empty($instance['rss']) ? ' ' : apply_filters('widget_rss', $instance['rss']);
	$rss_link="'".$rss."'";

	$soundcloud = empty($instance['soundcloud']) ? ' ' : apply_filters('widget_soundcloud', $instance['soundcloud']);
	$soundcloud_link="'http://soundcloud.com/".$soundcloud."'";

	$blogger = empty($instance['blogger']) ? ' ' : apply_filters('widget_blogger', $instance['blogger']);
	$blogger_link="'http://".$blogger.".blogspot.com/'";

	$reverbnation = empty($instance['reverbnation']) ? ' ' : apply_filters('widget_reverbnation', $instance['reverbnation']);
	$reverbnation_link="'http://reverbnation.com/".$reverbnation."'";

	$bandcamp = empty($instance['bandcamp']) ? ' ' : apply_filters('widget_bandcamp', $instance['bandcamp']);
	$bandcamp_link="'http://".$bandcamp.".bandcamp.com/'";


	// WIDGET BACKEND HTML CODE 
	echo <<<EOT
	<section class="widget-1 widget-first widget social-icons $css_class_holder " id="social-icons-widget-2" style="margin-top:$margin_top_var;padding-left:$margin_left_var;">
	<div class="widget-inner" >
		<ul class="social-icons-list" >
EOT;
if (!empty($instance['facebook'])) {
		echo <<<EOT
			<li class="facebook" style="opacity:$opacity_var;">
				<a href=$facebook_link >
					Facebook
				</a>
			</li>
EOT;
	}
if (!empty($instance['twitter'])) {
		echo <<<EOT
			<li class="twitter" style="opacity:$opacity_var;">
				<a href=$twitter_link >
					Twitter
				</a>
			</li>
EOT;
	}
if (!empty($instance['youtube'])) {
		echo <<<EOT
			<li class="youtube" style="opacity:$opacity_var;">
				<a href=$youtube_link >
					YouTube
				</a>
			</li>
EOT;
	}
if (!empty($instance['linkedin'])) {
		echo <<<EOT
		<li class="googleplus" style="opacity:$opacity_var;">
			<a href=$googleplus_link  >
				Google+
			</a>
		</li>
EOT;
	}
if (!empty($instance['googleplus'])) {
		echo <<<EOT
		<li class="linkedin" style="opacity:$opacity_var;">
			<a href=$linkedin_link >
				LinkedIn
			</a>
		</li>
EOT;
	}
if (!empty($instance['github'])) {
		echo <<<EOT
		<li class="github" style="opacity:$opacity_var;">
			<a href=$github_link >
				GitHub
			</a>
		</li>
EOT;
	}
if (!empty($instance['wordpress'])) {
		echo <<<EOT
			<li class="wordpress" style="opacity:$opacity_var;">
				<a href=$wordpress_link >
					WordPress
				</a>
			</li>
EOT;
	}
if (!empty($instance['drupal'])) {
		echo <<<EOT
			<li class="drupal" style="opacity:$opacity_var;">
				<a href=$drupal_link >
					Drupal
				</a>
			</li>
EOT;
	}
if (!empty($instance['instagram'])) {
		echo <<<EOT
		<li class="instagram" style="opacity:$opacity_var;">
			<a href=$instagram_link  >
				Instagram
			</a>
		</li>
EOT;
	}
if (!empty($instance['pinterest'])) {
		echo <<<EOT
		<li class="pinterest" style="opacity:$opacity_var;">
			<a href=$pinterest_link >
				Pinterest
			</a>
		</li>
EOT;
	}
if (!empty($instance['yelp'])) {
		echo <<<EOT
		<li class="yelp" style="opacity:$opacity_var;">
			<a href=$yelp_link >
				Yelp
			</a>
		</li>
EOT;
	}
if (!empty($instance['email'])) {
		echo <<<EOT
		<li class="email" style="opacity:$opacity_var;">
			<a href=$email_link >
				Email
			</a>
		</li>
EOT;
}
if (!empty($instance['rss'])) {
		echo <<<EOT
			<li class="rss" style="opacity:$opacity_var;">
				<a href=$rss_link >
					RSS
				</a>
			</li>
EOT;
	}
if (!empty($instance['soundcloud'])) {
		echo <<<EOT
			<li class="soundcloud" style="opacity:$opacity_var;">
				<a href=$soundcloud_link >
					SoundCloud
				</a>
			</li>
EOT;
	}
if (!empty($instance['blogger'])) {
		echo <<<EOT
		<li class="blogger" style="opacity:$opacity_var;">
			<a href=$blogger_link  >
				Blogger
			</a>
		</li>
EOT;
	}
if (!empty($instance['reverbnation'])) {
		echo <<<EOT
		<li class="reverbnation" style="opacity:$opacity_var;">
			<a href=$reverbnation_link >
				Reverbnation
			</a>
		</li>
EOT;
	}
if (!empty($instance['bandcamp'])) {
		echo <<<EOT
		<li class="bandcamp" style="opacity:$opacity_var;">
			<a href=$bandcamp_link >
				Bandcamp
			</a>
		</li>
EOT;
	}
	
	echo "</ul></div></section>".$after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("SocialMediaIcons");') );
?>