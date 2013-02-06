<?php 
/*
Plugin Name: WP Flicker
Plugin URI: http://fanush.edevs.net/wp-flicker
Description: Description
Version: 0.1
Author: Fanush Team
Author URI: http://fanush.edevs.net/
*/

/**
 * Copyright (c) 2013, Fanush Team. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */


define('WPF_FOLDER', dirname(plugin_basename(__FILE__)));
define('WPF_URL', WP_PLUGIN_URL.'/'.WPF_FOLDER);
global $wpdb;
global $wp_query;

require_once('wpf-widgets.php');

class WPFlicker{

  var $pluginPath;
	var $pluginUrl;

	/*********************************
	## Construct Function
	## Set Plugin Path and URL
	## Add shortcode Function
	## Add shortcode support for widget
	**********************************/

	Public function __construct(){
		$this->pluginPath = dirname(__FILE__);
		$this->pluginUrl = WP_PLUGIN_URL . '/wp-flicker';
		add_shortcode( 'flickergallery', array($this, 'Wpf_shortcode')) 	;
		add_action( 'wp_enqueue_scripts', 'wpflicker_scripts');
   		add_filter('widget_text', 'do_shortcode'); 
	}

	/************************************************************
	## Shortcode with specific parameter
	## Call Get Image function to return Images form Flicker
	************************************************************/

	public function Wpf_shortcode($atts){
		extract(shortcode_atts(array(
		    'images' 			=> '20',
		    'flickerid' 		=> '37304598@N02',
		    'type' 				=> 'popup',
		    'id'				=> rand(100, 999),
		    'theme'				=>'light_rounded',
		    'slideshow'    		=>'6000',
		    'imagesize'			=>'small',
	    ), $atts));

	   return $this->get_images($id, $images, $flickerid, $type, $theme,$slideshow, $imagesize);  
	}
	
	/***************************************
	## Get images from flicker feed
	## Display as specific parameter
	## Add prettyPhoto Comfortablity
	## Return HTML to Write it into the ID
	**************************************/
	public function get_images($id, $number, $flickerid, $type, $theme,$slideshow, $imagesize ){

		if($imagesize=='medium'){
			$imagesize = '{{image_m}}';
		}else{
			$imagesize = '{{image_s}}';
		}
	
		$html ='';
     	$html .='<div class="content_gallery">
					<div class="flicker_gallery">
						<ul id="cbox_'.$id.'" class="thumbs gallery"></ul>
					</div>
				</div>
				<div class="clear">	</div>';

		$html .="<script type=\"text/javascript\">
						jQuery(document).ready(function(){
								jQuery('#cbox_".$id."').jflickrfeed({
									limit: ".$number.",
									qstrings: {
										id: '".$flickerid."'
									},
									itemTemplate: '<li>'+
													'<a rel=\"prettyPhoto[gallery$id]\" href=\"{{image}}\" title=\"{{title}}\">' +
														'<img src=\"$imagesize\" alt=\"{{title}}\" />' +
													'</a>' +
												  '</li>'
								}, function(data) {
									jQuery(\"area[rel^='prettyPhoto']\").prettyPhoto();
									jQuery(\".gallery:first a[rel^='prettyPhoto']\").prettyPhoto({animation_speed:'normal', theme:\"$theme\",slideshow:\"$slideshow\", autoplay_slideshow: true,  deeplinking: false});
									
									jQuery(\".gallery:gt(0) a[rel^='prettyPhoto']\").prettyPhoto({animation_speed:'normal',slideshow:10000, hideflash: true, deeplinking: false});
								});
							});
							</script>";
		    return $html;
	}

}
	
$wpflicker = new WPFlicker();

	/*********************************
	## Add style and scripts
	## Library
	## Flicker Feed
	## Preety Photo
	## Cycle
	*********************************/

	function wpflicker_scripts() {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'WPFlicker-Script', WPF_URL.'/scripts/jflickrfeed.js', '1.0', true );
		wp_enqueue_script( 'PrettyPhoto', WPF_URL.'/scripts/jquery.prettyPhoto.js', '1.0', true );
		wp_enqueue_script( 'Cycle', WPF_URL.'/scripts/jquery.cycle.all.min.js', '1.0', true );
		wp_enqueue_style( 'WPFlicker-Style', WPF_URL.'/styles/flicker-style.css', '1.0', true );
		wp_enqueue_style( 'PrettyPhoto-Style', WPF_URL.'/styles/prettyPhoto.css', '1.0', true );
		
	}


?>
