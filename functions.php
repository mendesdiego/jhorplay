<?php
global $wpdb;

require_once('functions/includes.php');
require_once('functions/add_meta_box_feedback.php');
require_once('functions/add_meta_box_cadastro.php');
//require_once('functions/add_metabox_dashboard.php');
// require ('functions/wp_bootstrap_menuwalker.php');
//  Para utilizar a passagem de valor entre os templates parts utilziar include(locate_template('parts/arquivo-part.php'));
//require_once('functions/add-grid-coluns.php');
// require ('functions/translate-acf-date.php');
require_once('functions/ctp.php');
// require ('functions/nav_menu_principal.php');
// require ('functions/add_options_page.php');
// require('functions/opcoes-thema.php');
include ('functions/acf_fields.php');
// require ('functions/remove-menus.php');
// require ('functions/contabiliza-post-acessado.php');
// require ('functions/ajax-search-results.php');

// funçnao especial ValeNet
// require ('functions/class.carrega-planos.php');

// remove a barra de admin do front do site
show_admin_bar(false);

// habilita upload de svg para o site
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// cores para categorias de cursos
global $argLoopDestaque, $sessaoID, $idPostCorrente;  // Variavel global para criação de loops

global $tituloSessao,$corSessao,$queried_object; // sempre que precisar trocar uma cor da sessao corrente

// add_action('init', 'carregaCoresCategoria');

// $primaryColorA = "136, 183, 193";
// $primaryColorB = "79, 148, 166";
// $primaryColorC = "17, 112, 135";
// $primaryColorD = "9, 88, 107";
//
// $secondaryColorA = "201, 162, 252";
// $secondaryColorB = "175, 118, 252";
// $secondaryColorC = "149, 75, 251";
// $secondaryColorD = "94, 39, 175";
// /cores para categorias de cursos

global $diretorio;
$diretorio = get_template_directory();


// converte hexadecimal para RGB
function hexToRgb($hex, $alpha = false) {
  $hex      = str_replace('#', '', $hex);
  $length   = strlen($hex);
  $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
  $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
  $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
  if ( $alpha ) {
    $rgb['a'] = $alpha;
  }
  return $rgb;
}
//  modo de uso: echo hexToRgb($valorHexadecimalDaCor) ou echo hexToRgb($valorHexadecimalDaCor, $porcetagemDeTransparencia)

add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}

/********************************************************/
/************ custom logo ******************************/
/******************************************************/
add_theme_support( 'custom-logo',
  array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  )
);


/* Remove scripts não usados no Wordpress */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
/* Remove scripts não usados no Wordpress */

/* ----------------------------------------------------- */
/* Escondendo a versão do Wordpress */
/* ----------------------------------------------------- */
remove_action('wp_head', 'wp_generator');
/* ----------------------------------------------------- */
/* Abilitando suporte ao gerenciador de menus */
/* ----------------------------------------------------- */
register_nav_menus(
  array(
    'menu_topo'   => 'Menu navegação',
    'menu_superior' => 'Barra de menu superior',
    'menu_rodape_solucoes' => 'Menu soluções Rodapé',
    'menu_rodape' => 'Rodape'
  )
);
/*
Modo de uso:
<?php wp_nav_menu( array('theme_location'=>'menu_topo','menu_class'=>'menu') ); ?>
*/
/* ----------------------------------------------------- */
/* Abilitando suporte a imagens destacadas */
/* ----------------------------------------------------- */
if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );
add_image_size('thumb-loop-blog', 263, 160, true);
//add_image_size('thumb-custom-2', 66, 66, true);
/*
Modo de uso:
<?php the_post_thumbnail('thumbnail'); ?>

/* ----------------------------------------------------- */
/* Registrando uma sidebar */
/* ----------------------------------------------------- */
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Sidebar',
        'id'  => 'sidebar',
        'before_widget' => '<div class="main-sidebar__container">',
        'after_widget' => '</div>',
        'before_title' => '<div class="main-sidebar__title">',
        'after_title' => '</div><div class="main-sidebar__navigation">',
    )
);

// if ( function_exists('register_sidebar') )
//     register_sidebar(array(
//         'name' => 'Rodape 1',
//         'id'  => 'rodape-1',
//         'description' => 'Apenas para menu',
//         'before_widget' => '<div class="colum-footer">',
//         'after_widget' => '</div>',
//         'before_title' => '<ul>',
//         'after_title' => '</ul>',
//     )
// );
//
// if ( function_exists('register_sidebar') )
//     register_sidebar(array(
//         'name' => 'Rodape 4',
//         'id'  => 'rodape-4',
//         'before_widget' => '<div class="main-footer__contact-info-container">',
//         'after_widget' => '</div>',
//         'before_title' => '<div class="main-footer__contact-info main-footer__contact-info--highlight">',
//         'after_title' => '</div>',
//     )
// );

/*
Modo de uso:
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Lateral') ) :?>
    <p class="msg-info">Gerencie seus Widgets pelo painel administrativo do Wordpress.</p>
<?php endif; ?>
*/
/* ----------------------------------------------------- */
/* Resumo com limite de palavras customizada */
/* ----------------------------------------------------- */
function the_excerpt_limit($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        echo $excerpt;
}
/*
Modo de uso:
<?php the_excerpt_limit(20); ?>
*/
function wp_pagination($pages = '', $range = 9)
{
  global $wp_query;
  $query = $query ? $query : $wp_query;
  $big = 999999999;
  $max_num_pages = $query->max_num_pages;

  $paginate = paginate_links(
      array(
          'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'type'      => 'array',
          'total'     => $max_num_pages,
          'format'    => '?paged=%#%',
          'current'   => max( 1, get_query_var('paged') ),
          'prev_text' => __('&laquo;'),
          'next_text' => __('&raquo;'),
      )
  );
  if ( $max_num_pages > 1 && $paginate ) {
      echo '<ul class="pagination pagination-lg">';
      foreach ( $paginate as $page ) {
          echo '<li>' . $page . '</li>';
      }
      echo '</ul>';
  }
}

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }

    if(1 != $pages)
    {
      echo '<div class="main-pagination">';
        echo "<div class='main-pagination__container'>";
           //echo "<li> <span>Page ".$paged." of ".$pages."</span> </li>";

           // if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
           // seta esquerda
           if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='main-pagination__arrow main-pagination__arrow--left'></a>";

           echo "<span class='main-pagination__bullets'>";
          for ($i=1; $i <= $pages; $i++)
          {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
              if ($paged == $i):
                // corrente (active)
                echo  "<a class='main-pagination__bullet main-pagination__bullet--active' disabled>".$i."</a>";
              else:
                // bullet (pagination_bullet)
                echo "<a href='".get_pagenum_link($i)."' class=\"main-pagination__bullet\">".$i."</a>";
              endif;
          }
          }
          echo "</span>";
            // seta direita
          if ($paged < $pages && $showitems < $pages) echo "<a href='.get_pagenum_link($paged + 1).' class='main-pagination__arrow main-pagination__arrow--right'></a>";
          // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";

        echo "</div>";
    echo "</div>";
    }
}

function title_page(){
  if ( is_single() ) {
    bloginfo('name'); echo " | "; single_post_title();
  }elseif ( is_home() || is_front_page() ) {
    bloginfo('name'); echo ' | ';
    bloginfo('description');
  }elseif ( is_page() ) {
    single_post_title('');
  }elseif ( is_search() ) {
    bloginfo('name');
    echo ' | Search results for ' . wp_specialchars($s);
  }elseif ( is_404() ) {
    bloginfo('name');
    print ' | Not Found';
  }else {
    bloginfo('name');
    wp_title('|');
  }
}
function font_awesome_icons(){ ?>
  <link href="https://use.fontawesome.com/5ea516cbb3.css"  rel="stylesheet">
    <style>
    .dashicons-feedtest:before {
        content: "\f086" !important;
        font-family: 'FontAwesome' !important;
        font-size: 18px !important;
    }
    .dashicons-cadastro:before {
        content: "\f234" !important;
        font-family: 'FontAwesome' !important;
        font-size: 18px !important;
    }
  </style>
<?php }

add_action('admin_head', 'font_awesome_icons', 0);

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
if ( is_array( $plugins ) ) {
return array_diff( $plugins, array( 'wpemoji' ) );
} else {
return array();
}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
if ( 'dns-prefetch' == $relation_type ) {
/** This filter is documented in wp-includes/formatting.php */
$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
}

return $urls;
}


// function my_acf_init() {
// 	acf_update_setting('google_api_key', 'AIzaSyDisdRZVW7g78n4YboXlVYMjRZnsl9qVHk');
// }

// add_action('acf/init', 'my_acf_init');

// function my_acf_google_map_api( $api ){
// 	$api['key'] = 'AIzaSyB1OeYg9-8ryvyZukGaLX59ypygqYFTByk';
// 	return $api;
// }

// add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_action('wp_ajax_insereDados', 'insereDados');
add_action('wp_ajax_nopriv_insereDados', 'insereDados' ); // aparentemente não é obrigatorio utilizar este action
function insereDados(){
  // verifica o campo e dispara para o cadastro de usuário
  if ( wp_verify_nonce( $_POST['field_cadastro_user'], 'cadastro_user' ) )
  {
    echo processa_cadastros('cadastro');
    // verifica o campo e dispara para o feedback
  } else if( wp_verify_nonce( $_POST['field_feedback_user'], 'feedback_user' ) ){
    echo processa_cadastros('feedback');
  } else {
    // process form data
    echo "não processa o cadastro";
    exit;
  }
  die; 
}

function processa_cadastros($post_type)
{
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');

  $nome         = $_POST['nome'];
//  var_dump($_FILES['screenshot']);

    if(!empty($nome)){

        $argInsert = array(
            'post_title'  => $nome,
            'post_type'   => $post_type
        );

        $post = wp_insert_post($argInsert);
        //
        foreach ($_POST as $cadastro => $value) {
            add_post_meta( $post, $cadastro, $value );
        }

        $attachment_id = media_handle_upload( 'screenshot', $post );
        if ( is_numeric( $attachment_id ) ) {
            add_post_meta( $post, '_my_file_upload', $attachment_id );
        }


//        foreach ($_FILES['screenshot'] as $file => $value){
//            var_dump($file);
//            $attachment_id = media_handle_upload( 'screenshot', $post );
//            if ( is_numeric( $attachment_id ) ) {
//                add_post_meta( $post, '_my_file_upload', $attachment_id );
//            }
//        }

    }
  
//  $wpDataLayer = json_encode($_POST);
//  return  $wpDataLayer;
}
add_action('wp_ajax_renderVideo', 'renderVideo');
add_action('wp_ajax_nopriv_renderVideo', 'renderVideo' );
function renderVideo(){
    echo get_field('url_do_video', $_GET['postId'] );
}