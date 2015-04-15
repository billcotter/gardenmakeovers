<?php
/**
 * Template Name: Movies Page
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

/**
 * EA Genesis Child.
 *
 * @package      EAGenesisChild
 * @since        1.0.0
 * @copyright    Copyright (c) 2014, Contributors to EA Genesis Child project
 * @license      GPL-2.0+
 */
 
 

 
 function bjc_movie_page() {

 	$movies = get_post_meta( get_the_ID(), 'bjc_movies', true );
if( $movies ) {
  for( $i = 0; $i < $movies; $i++ ) {
    $title = esc_html( get_post_meta( get_the_ID(), 'bjc_movies_' . $i . '_title', true ) );
    $description = esc_url( get_post_meta( get_the_ID(), 'bjc_movies_' . $i . '_description', true ) );
    $thumbnail = (int) get_post_meta( get_the_ID(), 'bjc_movies' . $i . '_thumbnail', true );
    $year = (int) get_post_meta( get_the_ID(), 'bjc_movies' . $i . '_year', true );
    
    // Thumbnail field returns image ID, so grab image. If none provided, use default image
    $thumbnail = $thumbnail ? wp_get_attachment_image( $thumbnail, 'bjc_movie' ) : '<img src="' . get_stylesheet_directory_uri() . '/images/default-video.png" />';
    
    // Displayed in two columns, so using column classes
    $class = 0 == $i || 0 == $i % 2 ? 'one-half first' : 'one-half';
    
    // Build the video box
    echo '<div class="' . $class . '"><a href="' . $movie . '">' . $thumbnail . '</a>' . $title . '</div>';
    
  }
}


 	add_action( 'bjc_content_area', 'bjc_movie_page' );

// Remove 'site-inner' from structural wrap
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

// Build the page
get_header();
do_action( 'bjc_content_area' );
get_footer();