<?php
/*
Plugin Name: Wordpress FancyBox PlugIn
Plugin URI: http://www.rene-design.com/php-mysql-javascript-und-ajax/fancybox-wordpress-plugin
Feed URI: http://www.rene-design.com/feed/
Description: Adds the wordpress fancybox plugin to your blog
Version: 0.8.9
Author: Rene Kreupl
Author URI: http://www.rene-design.com
*/
 

function WPFancyBox_init() {
  $urlpath = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__));
  wp_enqueue_script('jquery');
	wp_enqueue_script('fancybox', $urlpath.'/fancybox/jquery.fancybox-1.2.1.pack.js', array('jquery'));
	wp_enqueue_script('easing', $urlpath.'/fancybox/jquery.easing.1.3.js', array('jquery'));
  wp_enqueue_style('fancybox', $urlpath.'/fancybox/jquery.fancybox.css');
}

function WPFancyBox_activate() {
  echo "<!-- FancyBox -->\r\n";
?>
  <script type="text/javascript">
  jQuery(document).ready(function() {
      jQuery('.fancybox').fancybox({'overlayShow': true, 'hideOnContentClick': true, 'overlayOpacity': 0.85});
    });
  </script>
<?php
  echo "<!-- FancyBox end -->\r\n";
}

function WPFancyBox_create($content){
  return preg_replace('/<a(.*?)href=(.*?).(jpg|jpeg|png|gif|bmp|ico)"(.*?)>/i', '<a$1href=$2.$3" $4 class="fancybox">', $content);
}
	
add_action('init', 'WPFancyBox_init');
add_filter('the_content', 'WPFancyBox_create', 2);
add_action('wp_head', 'WPFancyBox_activate');
?>