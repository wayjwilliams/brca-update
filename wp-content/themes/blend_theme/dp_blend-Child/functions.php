<?php
function dp_child_theme_stylesheet() {
  wp_enqueue_style('dp_child_css', get_stylesheet_uri(), false, null);
}
add_action('wp_enqueue_scripts', 'dp_child_theme_stylesheet', 110);

