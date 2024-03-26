<?php
// adiciona a coluna no grid
add_filter( 'manage_feedback_posts_columns', 'set_custom_edit_grid_columns' );
function set_custom_edit_grid_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date'] );
    $columns['categoria-feedback'] = __( 'Categoria', 'your_text_domain' );
    $columns['validacao-feedback'] = __( 'Validação', 'your_text_domain' );
    $columns['tags-feedback'] = __( 'Tags', 'your_text_domain' );
    $columns['email'] = __( 'E-mail', 'your_text_domain' );
    $columns['telefone'] = __( 'Telefone', 'your_text_domain' );
    $columns['data'] = __( 'Data', 'your_text_domain' );

    return $columns;
}

// popula a coluna do grid
add_action( 'manage_feedback_posts_custom_column' , 'custom_grid_column', 10, 2 );
function custom_grid_column( $column, $post_id ) {
    switch ( $column ) {

        case 'categoria-feedback' :
            $terms = get_the_term_list( $post_id , 'categoria-feedback' , '' , ',' , '' );
                if ( is_string( $terms ) ):
                    echo $terms;
                else:
                    _e( 'Nenuma categoria associada', 'your_text_domain' );
                endif;
            break;

        case 'validacao-feedback' :
            $terms = get_the_term_list( $post_id , 'validacao-feedback' , '' , ',' , '' );
                if ( is_string( $terms ) ):
                    echo $terms;
                else:
                    _e( 'Nenuma categoria associada', 'your_text_domain' );
                endif;
            break;

        case 'tags-feedback' :
            $terms = get_the_term_list( $post_id , 'tags-feedback' , '' , ',' , '' );
                if ( is_string( $terms ) ):
                    echo $terms;
                else:
                    _e( 'Nenuma categoria associada', 'your_text_domain' );
                endif;
            break;

        case 'email' :
            $email = get_post_meta( $post_id, 'email', true );
            echo $email;
            break;

        case 'telefone' :
            $email = get_post_meta( $post_id, 'telefone', true );
            echo $email;
            break;

        case 'data':
            $codigoCurso = get_the_date( 'd/m/Y', $post_id );
            echo $codigoCurso;
            break;
    }
}

// torna a coluna clicavel para ordenação
add_filter( 'manage_edit-feedback_sortable_columns', 'my_sortable_cake_column' );
function my_sortable_cake_column( $columns ) {
    $columns['categoria-feedback'] = 'categoria-feedback';
    $columns['validacao-feedback'] = 'validacao-feedback';
    $columns['tags-feedback'] = 'tags-feedback';
    $columns['email'] = 'email';
    $columns['data'] = 'data';
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);

    return $columns;
}

// add_filter( 'manage_edit-cursos_sortable_columns', 'area_conhecimento_sortable' );
// function area_conhecimento_sortable( $columns ) {
//     $columns['area-de-conhecimento'] = 'area-de-conhecimento';
//     //To make a column 'un-sortable' remove it from the array
//     //unset($columns['date']);
//
//     return $columns;
// }

// gera filtro dropdown para categorias curso
add_action( 'restrict_manage_posts', 'my_filter_list' );
function my_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'feedback' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Todos as categorias',
            'taxonomy' => 'categoria-feedback',
            'name' => 'categoria-feedback',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['categoria-feedback'] ) ? $wp_query->query['categoria-feedback'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}

// passa a query para realizar o friltro categoria cursos
add_filter( 'parse_query','perform_filtering' );
function perform_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( isset( $qv['categoria-feedback'] ) && is_numeric( $qv['categoria-feedback'] ) ) {
        $term = get_term_by( 'id', $qv['categoria-feedback'], 'categoria-feedback' );
        if (!empty($term->slug)) {
            $qv['categoria-feedback'] = $term->slug;
        }
    }
}

//  cria o filtro dropdown para area de conhecimento
add_action( 'restrict_manage_posts', 'filtro_area_conhecimento' );
function filtro_area_conhecimento() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'feedback' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Todos as áreas de conhecimento',
            'taxonomy' => 'validacao-feedback',
            'name' => 'validacao-feedback',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['validacao-feedback'] ) ? $wp_query->query['validacao-feedback'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}

//  realiza a query para fazer o filtro de area de conhecimento
add_filter( 'parse_query','filtra_area_cinhecimento' );
function filtra_area_cinhecimento( $query ) {
    $qv = &$query->query_vars;
    if ( isset( $qv['validacao-feedback'] ) && is_numeric( $qv['validacao-feedback'] ) ) {
        $term = get_term_by( 'id', $qv['validacao-feedback'], 'validacao-feedback' );
        if (!empty($term->slug)) {
            $qv['validacao-feedback'] = $term->slug;
        }

    }
}

// add_filter( 'request', 'column_ordering' );
// add_filter( 'request', 'column_orderby' );

// function column_orderby ( $vars ) {
//     if ( !is_admin() )
//         return $vars;
//     if ( isset( $vars['orderby'] ) && 'categoria-cursos' == $vars['orderby'] ) {
//         $vars = array_merge( $vars, array( 'taxonomy' => 'categoria-cursos', 'orderby' => 'term_name' ) );
//     }
//     // elseif ( isset( $vars['orderby'] ) && 'area-de-conhecimento' == $vars['orderby'] ) {
//     //     $vars = array_merge( $vars, array( 'taxonomy' => 'area-de-conhecimento', 'orderby' => 'term_name' ) );
//     // }
//
//     return $vars;
// }
