<?php

/**
 * Template Name: Testimonial Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action('genesis_loop','genesis_do_loop');

add_action('genesis_loop','surefire_loop_helper');

function surefire_loop_helper() {
//Create a standard wordpress loop
while(have_posts()) : the_post();

echo '&lt;div class="title"&gt;'. the_title() .'&lt;/div&gt;';
echo '&lt;div class="thecontent"&gt;' . the_content() . '&lt;/div&gt;';

endwhile;
}
genesis();