=== Plugin Name ===
Contributors: dotcomdotbd
Tags: Flicker, Image Gallery, Jquery Cycle Gallery, PrettyPhoto Gallery, Flicker Photo Gallery
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 0.1


WP Flicker plugin will display your flicker images just like a nice image gallery. Do not need any API key. Shortcode and custom widget available. 

== Description ==

WP Flicker is a very easy to manage plugin to display nice Photo Gallery with flicker Images. You do not need any API key. Just use your Flicker User ID. WP Flicker will grab images from flicker feed. So you do not need to upload images on your server. You will a get shortcode with a lot of options and also a custom widget for single image gallery. PrettyPhoto jQuery plugin is used for image popup.

Sample Usage:

[flickergallery images='NUMBER_OF_IMAGE' flickerid="YOUR_FLICKER_USERID"]

Parameters:

'images' : Number of image to display eg. 20
'flickerid' : Your flicker ID, eg. 37304598@N02
'theme'  : theme for image popup available form prettyphoto jQuery Plugin. You can use light_rounded, dark_rounded, dark_square, light_square, facebook
'slideshow' : time of slideshow after popup, In milesecond eg.  6000,
'imagesize' : Image size to display. 'small' and 'medium' available


Simple Example:
[flickergallery images='12' flickerid="83639076@N06"]

Advance Usage: 
[flickergallery images='8' flickerid="7511731@N06" imagesize="medium" theme="facebook"]

 
Visit Demo: <a href="http://fanush.edevs.net/wp-flicker/" target="_blank">Demo Page </a>

Special Thanks to: <a href="http://www.newmediacampaigns.com/page/jquery-flickr-plugin" target="_blank">Joel Sutherland</a>


== Installation ==

1. Upload the plugin to the \`/wp-content/plugins/\` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use [flickergallery images='NUMBER_OF_IMAGE' flickerid="YOUR_FLICKER_USERID"] shortcode on you post/page/widget
4. You will find a custom widget too

== Frequently Asked Questions ==

= How do I get my Flicker User ID? =
  Here is a very simple way to find it. Please check it: http://idgettr.com/

= Can I use this shortcode into Widget? =

	Yes. WP FLicker's shortcode will support post/page/widget. You can also use do_shortcode PHP function to use this shortcode inside the template.

== Screenshots ==


== Changelog ==

= 0.1 =
First Version of WP Flicker

