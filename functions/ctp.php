<?php
add_action('init', 'create_posttype' );
function create_posttype(){
  // cria os post_type necessário
//  register_post_type('feedback',
//    array(
//      'labels' => array(
//        'name' => __( 'Feedbacks', 'boilerplate' ),
//        'singular_name' => __('feedback', 'boilerplate' )
//      ),
//      'show_in_rest' => true,
//      'public' => true,
//      'hierarchical' => true,
//      'has_archive' => 'feedback',
//      'menu_icon' => 'dashicons-feedtest',
//      'menu_position' => 5,
//      'rewrite' => array('slug' => 'feedback'),
//      'supports' => array(
//        'title',
//        // 'editor',
//        // 'page-attributes',
//        // 'thumbnail'
//      )
//    )
//  );
//
//  register_taxonomy(
//    'categoria-feedback',
//    'feedback',
//    array(
//      'label' => __( 'Categorias', 'boilerplate' ),
//      'rewrite' => array( 'slug' => 'categoria-feedback' ),
//      'hierarchical' => true,
//    )
//  );

  // cria os post_type necessário
  register_post_type('depoimentos',
    array(
      'labels' => array(
        'name' => __( 'Depoimentos', 'boilerplate' ),
        'singular_name' => __( 'Depoimento', 'boilerplate' )
      ),
      'show_in_rest' => true,
      'public' => true,
      'hierarchical' => true,
      // 'has_archive' => 'cadastro',
      'menu_icon' => 'dashicons-feedtest',
      'menu_position' => 5,
      'rewrite' => array('slug' => 'cadastro'),
      'supports' => array(
        'title',
         'editor',
        // 'page-attributes',
         'thumbnail'
      )
    )
  );



  // register_taxonomy(
  //   'categoria-portfolio',
  //   'portfolio',
  //   array(
  //     'label' => __( 'Categorias portfolio', 'Microcity' ),
  //     'rewrite' => array( 'slug' => 'categoria-portfolio' ),
  //     'hierarchical' => true,
  //   )
  // );

}
