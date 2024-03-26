<?php
function register_ajaxLoop_script() {
    // !is_page() and !is_single() and !is_home() and !is_archive('cursos')
    if (is_tax()) {
        // echo 'teste';
        wp_register_script(
          'ajaxLoop',
           get_stylesheet_directory_uri() . '/assets/js/ajaxLoop.js',
           array('jquery')
        );
        wp_enqueue_script('ajaxLoop');
    }
}

add_action('wp_enqueue_scripts', 'register_ajaxLoop_script');
