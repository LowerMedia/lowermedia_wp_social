<?php
/*
Plugin Name: LowerMedia WP Social
Plugin URI: http://lowermedia.net
Description: Social Media Toolbar Made Easy! Creates widget and widget area to display social media profile links at the top or left of your website.
Version: 3.0.3
Stable: 2.1.0
Author: Pete Lower
Author URI: http://petelower.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*############################################################################################
#
#   ADD ADMIN MENU
#
*/

class lowermedia_wp_social_admin {
    public function __construct(){
        if(is_admin()){
	    	add_action('admin_menu', array($this, 'lmwps_options_page'));
	    	add_action('admin_init', array($this, 'page_init'));
		}
    }
	
    public function lmwps_options_page(){
		add_menu_page('LowerMedia WP Social Options', 'WPS Options', 'manage_options', 'lmwps-admin-options', array($this, 'lmwps_options'), plugins_url('lowermedia-wp-social/icons/favicon.ico'));//, _FILE_
    }

    public function lmwps_options(){
    ?>
		<div class="wrap">
		    <?php screen_icon(); ?>
		    <h2><a href="https://lowermedia.net">LowerMedia</a> WP Social</h2>	
		    <br/><br/><center><strong>ADD STYLE INFO BELOW</strong></center></br><hr />		
		    <form method="post" action="options.php">
		        <?php
		            // This prints out all hidden setting fields
				    settings_fields('lowermedia_wps_option_group');	
				    do_settings_sections('lmwps-admin-options');
				    submit_button();
				?>
		    </form>
		</div>
	<?php
    }
	
    public function page_init(){		
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_enable', array($this, 'check_enable'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_rounded', array($this, 'check_rounded'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_bkgrnd', array($this, 'check_bkgrnd'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_offsite', array($this, 'check_offsite'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_flaticons', array($this, 'check_flaticons'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_martop', array($this, 'check_martop'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_marleft', array($this, 'check_marleft'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_pos', array($this, 'check_pos'));
		register_setting('lowermedia_wps_option_group', 'lmwps_wps_opac', array($this, 'check_opac'));
		//register_setting('lowermedia_wps_option_group', '{NAME HERE}', array($this, 'check_{FUNCTION NAME HERE}'));

		/*	ADD SETTINGS SECTION 	*/
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

		add_settings_section(
		    'lmwps_wps_offsite',
		    '<!-- Check Box -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);

		add_settings_section(
		    'lmwps_wps_flaticons',
		    '<!-- Check Box -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);

		add_settings_section(
		    'lmwps_wps_martop',
		    '<!-- Text Field -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);

		add_settings_section(
		    'lmwps_wps_marleft',
		    '<!-- Text Field -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);

		add_settings_section(
		    'lmwps_wps_pos',
		    '<!-- Text Field -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);

		add_settings_section(
		    'lmwps_wps_opac',
		    '<!-- Text Field -->',
		    array($this, 'print_section_info'),
		    'lmwps-admin-options'
		);	
		
		/*	ADD SETTING FIELD 	*/
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

		add_settings_field(
		    'lmwps_offsite', 
		    'Open links in new tab?', 
		    array($this, 'lmwps_offsite'), 
		    'lmwps-admin-options',
		    'lmwps_wps_offsite'			
		);	

		add_settings_field(
		    'lmwps_flaticons', 
		    'Use Flat Icons (Thanks FontAwesome!)?', 
		    array($this, 'lmwps_flaticons'), 
		    'lmwps-admin-options',
		    'lmwps_wps_flaticons'			
		);

		add_settings_field(
		    'lmwps_martop', 
		    'Enter Margin Top (px % em):', 
		    array($this, 'lmwps_martop'), 
		    'lmwps-admin-options',
		    'lmwps_wps_martop'			
		);

		add_settings_field(
		    'lmwps_marleft', 
		    'Enter Margin Left (px % em):', 
		    array($this, 'lmwps_marleft'), 
		    'lmwps-admin-options',
		    'lmwps_wps_marleft'			
		);	

		add_settings_field(
		    'lmwps_pos', 
		    'Position (top or side):', 
		    array($this, 'lmwps_pos'), 
		    'lmwps-admin-options',
		    'lmwps_wps_pos'			
		);

		add_settings_field(
		    'lmwps_opac', 
		    'Enter Opacity (.01-.9):', 
		    array($this, 'lmwps_opac'), 
		    'lmwps-admin-options',
		    'lmwps_wps_opac'			
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

    function check_offsite($input){

 		$output = $input['lmwps_offsite'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_offsite'])) {
		    if(get_option('lmwps_offsite_option') === FALSE){
				add_option('lmwps_offsite_option', $output);
		    }else{
				update_option('lmwps_offsite_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_offsite_option');
		}
		return $output;
    }

    function check_flaticons($input){

 		$output = $input['lmwps_flaticons'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_flaticons'])) {
		    if(get_option('lmwps_flaticons_option') === FALSE){
				add_option('lmwps_flaticons_option', $output);
		    }else{
				update_option('lmwps_flaticons_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_flaticons_option');
		}
		return $output;
    }

    function check_martop($input){

 		$output = $input['lmwps_martop'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_martop'])) {
		    if(get_option('lmwps_martop_option') === FALSE){
				add_option('lmwps_martop_option', $output);
		    }else{
				update_option('lmwps_martop_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_martop_option');
		}
		return $output;
    }

    function check_marleft($input){

 		$output = $input['lmwps_marleft'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_marleft'])) {
		    if(get_option('lmwps_marleft_option') === FALSE){
				add_option('lmwps_marleft_option', $output);
		    }else{
				update_option('lmwps_marleft_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_marleft_option');
		}
		return $output;
    }

    function check_pos($input){

 		$output = $input['lmwps_pos'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_pos'])) {
		    if(get_option('lmwps_pos_option') === FALSE){
				add_option('lmwps_pos_option', $output);
		    }else{
				update_option('lmwps_pos_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_pos_option');
		}
		return $output;
    }

    function check_opac($input){

 		$output = $input['lmwps_opac'];

 		//check if the checkbox was checked
 		//if it was add or update the option
    	if(isset($input['lmwps_opac'])) {
		    if(get_option('lmwps_opac_option') === FALSE){
				add_option('lmwps_opac_option', $output);
		    }else{
				update_option('lmwps_opac_option', $output);
		    }
		}else{//if it wasn't delete the option
				delete_option('lmwps_opac_option');
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
		        <?php if ( get_option('lmwps_enable_option') ) {echo 'checked="checked"'; } ?> 
	    	/>
	    <?php
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

    function lmwps_offsite(){
        ?>
	        <input 
		        type="checkbox" 
		        id="lmwps_offsite" 
		        name="lmwps_wps_offsite[lmwps_offsite]" 
		        value="1" 
		        <?php if ( get_option('lmwps_offsite_option') ) {echo 'checked="checked"'; } ?> 
	    	/>
	    <?php

    }

    function lmwps_flaticons(){
        ?>
	        <input 
		        type="checkbox" 
		        id="lmwps_flaticons" 
		        name="lmwps_wps_flaticons[lmwps_flaticons]" 
		        value="1" 
		        <?php if ( get_option('lmwps_flaticons_option') ) {echo 'checked="checked"'; } ?> 
	    	/>
	    <?php

    }

    function lmwps_martop(){
    	?>
		    <input 
		  		class="" 
		  		id="lmwps_wps_martop" 
		  		name="lmwps_wps_martop[lmwps_martop]" 
		  		type="text" 
		  		size="5"
		  		value="<?php echo get_option('lmwps_martop_option'); ?>" 
	  		/>
	    <?php
	}

    function lmwps_marleft(){
    	?>
  			<input 
		  		class="" 
		  		id="lmwps_wps_marleft" 
		  		name="lmwps_wps_marleft[lmwps_marleft]" 
		  		type="text" 
		  		size="5"
		  		value="<?php echo get_option('lmwps_marleft_option'); ?>" 
	  		/>
		<?php
	}

    function lmwps_pos(){
    	?>
			Position: <input 
		  		class="" 
		  		id="lmwps_wps_pos" 
		  		name="lmwps_wps_pos[lmwps_pos]" 
		  		type="text" 
		  		size="5"
		  		value="<?php echo get_option('lmwps_pos_option'); ?>" 
	  		/>
		<?php
	}

    function lmwps_opac(){
    	?>
			Add Opacity (.01 -.9): <input 
		  		class="" 
		  		id="lmwps_wps_opac" 
		  		name="lmwps_wps_opac[lmwps_opac]" 
		  		type="text" 
		  		size="5"
		  		value="<?php echo get_option('lmwps_opac_option'); ?>" 
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
#	//Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript (From Codex)
*/
	add_action( 'wp_enqueue_scripts', 'lowermedia_add_my_stylesheet' );
	
	/**
	 * Enqueue plugin style-file
	 */
	function lowermedia_add_my_stylesheet() {
	    //Only enque the style if the plugin is enabled in the plugins admin section
	    if ( get_option('lmwps_enable_option')) {
	    	// Respects SSL, Style.css is relative to the current file
		    wp_register_style( 'lowermedia-style', plugins_url('style.css', __FILE__) );
		    wp_register_style( 'font-awesome-style', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');

		    wp_enqueue_style( 'lowermedia-style' );
		    wp_enqueue_style( 'font-awesome-style' );
		}
	}

/*############################################################################################
#
#    Add Admin Area Links to Plugin Area
#   //This function displays links in the plugin by the deactivate link
*/

// Add settings link on plugin page
function lowermedia_add_plugin_links($links) { 
	$settings_link = '<a href="/wp-admin/widgets.php">Set Widget</a>'; 
	array_unshift($links, $settings_link); 

	$settings_link = '<a href="/wp-admin/admin.php?page=lmwps-admin-options">Enable/Config</a>'; 
	array_unshift($links, $settings_link); 				

	return $links; 
}
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'lowermedia_add_plugin_links');


/*############################################################################################
#
#   REGISTER SIDEBAR AREA FOR WIDGET
#   //This function creates and registers the social media icon holder widget
*/
	function lowermedia_wp_social_init() {
	    register_sidebar( array(
			'name' => 'Social Media Area',
			'id' => 'lowermedia_wp_social_widget_area',
			'before_widget' => '<div id="lowermedia-wp-social-wrap" class="lowermedia-wp-social-wrap">',
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
		//check if enabled option is selected
		if ( get_option('lmwps_enable_option')) {

			//check if rounded option is selected
			if (get_option('lmwps_rounded_option')){
				$GLOBALS['css_class_rounded'] = " lm-wps-rounded ";
			}else {$GLOBALS['css_class_rounded'] ='';}

			//check if the background option is selected
			if (get_option('lmwps_bkgrnd_option')){
				$GLOBALS['css_class_bkgrnd']  = " lm-wps-bkgrnd ";
			}else {$GLOBALS['css_class_bkgrnd'] ='';}

			//check if the links open in new tab option is selected
			if (get_option('lmwps_offsite_option')){
				$GLOBALS['link_offsite']  = " target='_blank' ";
			} else {$GLOBALS['link_offsite'] ='';}

			//If the user checks the box to use flat icons
			if (get_option('lmwps_flaticons_option')){
				$GLOBALS['link_flaticons']  = 'icon-2x icon-';
				$GLOBALS['disable']  = 'disable';
			}  else  {
				$GLOBALS['link_flaticons'] =' ';
				$GLOBALS['disable']  = '';
			}

			//check if margin top is set
			if (get_option('lmwps_martop_option')){
				$GLOBALS['css_class_martop'] = get_option('lmwps_martop_option');
			} else {$GLOBALS['css_class_martop'] ='';}

			//check if margin left is set
			if (get_option('lmwps_marleft_option')){
				$GLOBALS['css_class_marleft'] = get_option('lmwps_marleft_option');
			} else {$GLOBALS['css_class_marleft'] ='';}
			
			//check if position is set
			if (get_option('lmwps_pos_option')){
				if (get_option('lmwps_pos_option') == "top" ){
					$GLOBALS['css_class_pos'] = " lm-wps-top-ul lm-wps-top "; 
				} else {
					$GLOBALS['css_class_pos'] = " lm-wps-side-ul lm-wps-side ";
				}
			}else {$GLOBALS['css_class_pos'] ='';}
			
			//check if opacity is set
			if (get_option('lmwps_opac_option')){
				$GLOBALS['css_class_opac'] = get_option('lmwps_opac_option');
			} else {$GLOBALS['css_class_opac'] ='';}
			
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
				'yelp'=>'',
				'email'=>'',
				'rss'=>'',
				'soundcloud' => '',
				'blogger'=>'',
				'reverbnation' => '',
				'bandcamp'=>'',
				'custom_one'=>'',
				'custom_two'=>'',
				'custom_three'=>'',
				'custom_four'=>'',
			)
		);

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
	    $custom_one = $instance['custom_one'];
	    $custom_two = $instance['custom_two'];
	    $custom_three = $instance['custom_three'];
	    $custom_four = $instance['custom_four'];
	?>
  <p><hr /></br><strong><center>ADD LINK INFO BELOW</strong></center></br><hr /></br>
  	
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
	  	<label for="<?php echo $this->get_field_id('custom_one'); ?>">
			Custom Link: 	<br/>INCLUDE FULL LINK:<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('custom_one'); ?>" 
					  		name="<?php echo $this->get_field_name('custom_one'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($custom_one); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('custom_two'); ?>">
			Custom Link: 	<br/>INCLUDE FULL LINK:<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('custom_two'); ?>" 
					  		name="<?php echo $this->get_field_name('custom_two'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($custom_two); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('custom_three'); ?>">
			Custom Link: 	<br/>INCLUDE FULL LINK:<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('custom_three'); ?>" 
					  		name="<?php echo $this->get_field_name('custom_three'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($custom_three); ?>" 
				  		/>
	  	</label><br/></br>
	  	<label for="<?php echo $this->get_field_id('custom_four'); ?>">
			Custom Link: 	<br/>INCLUDE FULL LINK:<input 
					  		class="widefat" 
					  		id="<?php echo $this->get_field_id('custom_four'); ?>" 
					  		name="<?php echo $this->get_field_name('custom_four'); ?>" 
					  		type="text" 
					  		value="<?php echo esc_attr($custom_four); ?>" 
				  		/>
	  	</label><br/></br>
  </p>
	<?php
}
 
	function update($new_instance, $old_instance)
		{
			//strip tags for security
			$instance = $old_instance;
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
			$instance['custom_one'] = strip_tags($new_instance['custom_one']);
			$instance['custom_two'] = strip_tags($new_instance['custom_two']);
			$instance['custom_three'] = strip_tags($new_instance['custom_three']);
			$instance['custom_four'] = strip_tags($new_instance['custom_four']);
			return $instance;
		}
 
  function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$css_class_holder = $GLOBALS['css_class_bkgrnd']." ".$GLOBALS['css_class_rounded']." ".$GLOBALS['css_class_pos'];//".$GLOBALS['css_class_section']."

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

		$custom_one = empty($instance['custom_one']) ? ' ' : apply_filters('widget_custom_one', $instance['custom_one']);
		$custom_one_link="'$custom_one'";
		$custom_two = empty($instance['custom_two']) ? ' ' : apply_filters('widget_custom_two', $instance['custom_two']);
		$custom_two_link="'$custom_two'";
		$custom_three = empty($instance['custom_three']) ? ' ' : apply_filters('widget_custom_three', $instance['custom_three']);
		$custom_three_link="'$custom_three'";
		$custom_four = empty($instance['custom_four']) ? ' ' : apply_filters('widget_custom_four', $instance['custom_four']);
		$custom_four_link="'$custom_four'";

		$martop = $GLOBALS['css_class_martop'];
		$marleft = $GLOBALS['css_class_marleft'];

		$link_offsite = $GLOBALS['link_offsite'];

		$flaticons=$GLOBALS['link_flaticons'];
		$disable = $GLOBALS['disable'] ;

		$opac = $GLOBALS['css_class_opac'] ;
// WIDGET BACKEND HTML CODE 
		echo <<<EOT
		<section class="widget-1 widget-first widget social-icons $css_class_holder " id="social-icons-widget-2" style="margin-top:$martop;padding-left:$marleft;">
		<div class="widget-inner" >
			<ul class="social-icons-list" >
EOT;
if (!empty($instance['facebook'])) {
		echo <<<EOT
			<li class="{$disable}facebook" style="opacity:$opac;">
				<a $link_offsite href=$facebook_link >
					<i class="{$flaticons}facebook"></i> Facebook
				</a>
			</li>
EOT;
	}
if (!empty($instance['twitter'])) {
		echo <<<EOT
			<li class="{$disable}twitter" style="opacity:$opac;">
				<a $link_offsite href=$twitter_link >
					<i class="{$flaticons}twitter"></i> <span>Twitter</span>
				</a>
			</li>
EOT;
	}
if (!empty($instance['youtube'])) {
		echo <<<EOT
			<li class="{$disable}youtube" style="opacity:$opac;">
				<a $link_offsite href=$youtube_link >
					<i class="{$flaticons}youtube"></i><span>YouTube</span>
				</a>
			</li>
EOT;
	}
if (!empty($instance['googleplus'])) {
		echo <<<EOT
		<li class="{$disable}google-plus" style="opacity:$opac;">
			<a $link_offsite href=$googleplus_link  >
				<i class="{$flaticons}google-plus"></i><span>Google+</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['linkedin'])) {
		echo <<<EOT
		<li class="{$disable}linkedin" style="opacity:$opac;">
			<a $link_offsite href=$linkedin_link >
				<i class="{$flaticons}linkedin"></i><span>LinkedIn</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['github'])) {
		echo <<<EOT
		<li class="{$disable}github" style="opacity:$opac;">
			<a $link_offsite href=$github_link >
				<i class="{$flaticons}github"></i><span>GitHub</span>
			</a>
		</li>
EOT;
	}

if (!empty($instance['instagram'])) {
		echo <<<EOT
		<li class="{$disable}instagram" style="opacity:$opac;">
			<a $link_offsite href=$instagram_link  >
				<i class="{$flaticons}instagram"></i><span>Instagram</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['pinterest'])) {
		echo <<<EOT
		<li class="{$disable}pinterest" style="opacity:$opac;">
			<a $link_offsite href=$pinterest_link >
				<i class="{$flaticons}pinterest"></i><span>Pinterest</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['rss'])) {
		echo <<<EOT
			<li class="{$disable}rss" style="opacity:$opac;">
				<a $link_offsite href=$rss_link >
					<i class="{$flaticons}rss"></i><span>RSS</span>
				</a>
			</li>
EOT;
}
if (!empty($instance['email'])) {
		echo <<<EOT
		<li class="{$disable}envelope" style="opacity:$opac;">
			<a $link_offsite href=$email_link >
				<i class="{$flaticons}envelope"></i><span>Email</span>
			</a>
		</li>
EOT;
}

if (!empty($instance['soundcloud'])) {
		echo <<<EOT
			<li class="soundcloud" style="opacity:$opac;">
				<a $link_offsite href=$soundcloud_link >
					<span>SoundCloud</span>
				</a>
			</li>
EOT;
	}
if (!empty($instance['blogger'])) {
		echo <<<EOT
		<li class="blogger" style="opacity:$opac;">
			<a $link_offsite href=$blogger_link  >
				<span>Blogger</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['reverbnation'])) {
		echo <<<EOT
		<li class="reverbnation" style="opacity:$opac;">
			<a $link_offsite href=$reverbnation_link >
				<span>Reverbnation</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['bandcamp'])) {
		echo <<<EOT
		<li class="bandcamp" style="opacity:$opac;">
			<a $link_offsite href=$bandcamp_link >
				<span>Bandcamp</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['yelp'])) {
		echo <<<EOT
		<li class="yelp" style="opacity:$opac;">
			<a $link_offsite href=$yelp_link >
				<span>Yelp</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['wordpress'])) {
		echo <<<EOT
			<li class="wordpress" style="opacity:$opac;">
				<a $link_offsite href=$wordpress_link >
					<span>WordPress</span>
				</a>
			</li>
EOT;
	}
if (!empty($instance['drupal'])) {
		echo <<<EOT
			<li class="drupal" style="opacity:$opac;">
				<a $link_offsite href=$drupal_link >
					<span>Drupal</span>
				</a>
			</li>
EOT;
	}

if (!empty($instance['custom_one'])) {
		echo <<<EOT
		<li class="custom_one" style="opacity:$opac;">
			<a $link_offsite href=$custom_one_link >
				<span>Custom Link</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['custom_two'])) {
		echo <<<EOT
		<li class="custom_two" style="opacity:$opac;">
			<a $link_offsite href=$custom_two_link >
				<span>Custom Link</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['custom_three'])) {
		echo <<<EOT
		<li class="custom_three" style="opacity:$opac;">
			<a $link_offsite href=$custom_three_link >
				<span>Custom Link</span>
			</a>
		</li>
EOT;
	}
if (!empty($instance['custom_four'])) {
		echo <<<EOT
		<li class="custom_four" style="opacity:$opac;">
			<a $link_offsite href=$custom_four_link >
				<span>Custom Link</span>
			</a>
		</li>
EOT;
	}
	echo "</ul></div></section>".$after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("SocialMediaIcons");') );
//i9MH?>