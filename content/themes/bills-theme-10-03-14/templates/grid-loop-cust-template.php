<?php


 /** Remove Post Info and Meta */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
?>
<h4>And here's the code in it's entirety!</h4>

<?php
/**
* @author Jonathan Perez
*/

/*
Template Name: Grid Loop for Custom Taxonomy
*/

// Do the Custom Loop
remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_loop', 'sf_custom_loop' );

function sf_custom_loop() {

echo '&lt;h1 class="entry-title"&gt;' . get_the_title() . '&lt;/h1&gt;';
the_content();

//WP Query Start

$per_page = 9;

$product_args = array(
'post_type' =&gt; 'messages',
'posts_per_page' =&gt; $per_page,
'paged' =&gt; get_query_var( 'paged' )
);
$products = genesis_custom_loop( $product_args );
}

//Add Post Class Filter
add_filter('post_class', 'sf_post_class');
function sf_post_class($classes) {
global $loop_counter;
$classes[] = 'one-third';
if ($loop_counter % 3 == 0) {
$classes[] .= 'first ';
}
return $classes;
}

// Remove The Default Featured Image
add_filter('genesis_options', 'define_genesis_setting_custom', 10, 2);
function define_genesis_setting_custom($options, $setting) {
if($setting == GENESIS_SETTINGS_FIELD) {
$options['content_archive_thumbnail'] = 0;
return $options;
}
}

//Add New Featured Image
add_action('genesis_before_post_title','surefire_market_post_image', 0) ;
function surefire_market_post_image() {
if ( has_post_thumbnail() ) {
$img = genesis_get_image( array( 'format' =&gt; 'url') );
printf( '&lt;a href="%s" title="%s"&gt;&lt;img src="%s/path/to/timthumb.php?src=%s&amp;w=225&amp;h=160" class="featured-image" /&gt;&lt;/a&gt;', get_permalink(), the_title_attribute( 'echo=0' ),get_stylesheet_directory_uri(),$img );
}
}

/** Move Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');

genesis();